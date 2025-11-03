<?php

namespace BrevoNewsletter;

use Kirby\Cms\App as Kirby;

class BrevoClient
{
  protected $apiKey;
  protected $kirby;
  protected $senderEmail;
  protected $senderName;
  protected $listIds;
  
  const API_BASE_URL = 'https://api.brevo.com/v3';
  
  public function __construct(Kirby $kirby)
  {
    $this->kirby = $kirby;
    $this->apiKey = $kirby->option('brevo-newsletter.brevo_api_key');
    $this->senderEmail = $kirby->option('brevo-newsletter.sender_email');
    $this->senderName = $kirby->option('brevo-newsletter.sender_name', 'Niehler Freiheit');
    $this->listIds = $kirby->option('brevo-newsletter.list_ids', []);
    
    if (!$this->apiKey) {
      throw new \Exception('Brevo API key not configured');
    }
    
    if (!$this->senderEmail) {
      throw new \Exception('Sender email not configured');
    }
  }
  
  /**
   * Send a test email to a specific address
   */
  public function sendTestEmail(string $testEmail): array
  {
    $htmlContent = $this->getEmailHtml();
    $subject = $this->generateSubject();
    
    $data = [
      'sender' => [
        'name' => $this->senderName,
        'email' => $this->senderEmail
      ],
      'to' => [
        [
          'email' => $testEmail,
          'name' => 'Test Recipient'
        ]
      ],
      'subject' => '[TEST] ' . $subject,
      'htmlContent' => $htmlContent
    ];
    
    return $this->apiRequest('/smtp/email', 'POST', $data);
  }
  
  /**
   * Create a draft campaign from form data
   */
  public function createDraftFromForm(array $formData): array
  {
    $subject = $this->generateSubject();
    $htmlContent = $this->getEmailHtmlNew($formData);
    
    // Format campaign name: "DRAFT Newsletter_MM/YY"
    $monthYear = $formData['monthYear']; // Format: "YYYY-MM"
    list($year, $month) = explode('-', $monthYear);
    $campaignName = sprintf('DRAFT Newsletter_%s/%s', $month, substr($year, -2));
    
    $campaignData = [
      'name' => $campaignName,
      'subject' => $subject,
      'sender' => [
        'name' => $this->senderName,
        'email' => $this->senderEmail
      ],
      'type' => 'classic',
      'htmlContent' => $htmlContent,
      'recipients' => [
        'listIds' => $this->listIds
      ]
    ];
    
    // Create the campaign (stays as draft)
    $campaign = $this->apiRequest('/emailCampaigns', 'POST', $campaignData);
    $campaignId = $campaign['id'] ?? null;
    
    if (!$campaignId) {
      throw new \Exception('Failed to create campaign');
    }
    
    return [
      'campaignId' => $campaignId,
      'campaignUrl' => "https://app.brevo.com/marketing-campaign/edit/{$campaignId}",
      'campaign' => $campaign,
      'usingTemplate' => false
    ];
  }
  
  /**
   * Send campaign immediately from form data
   */
  public function sendCampaignFromForm(array $formData): array
  {
    $subject = $this->generateSubject();
    $htmlContent = $this->getEmailHtmlNew($formData);
    
    // Create campaign
    $campaignData = [
      'name' => 'Newsletter - ' . date('Y-m-d H:i:s'),
      'subject' => $subject,
      'sender' => [
        'name' => $this->senderName,
        'email' => $this->senderEmail
      ],
      'type' => 'classic',
      'htmlContent' => $htmlContent,
      'recipients' => [
        'listIds' => $this->listIds
      ]
    ];
    
    // Create the campaign
    $campaign = $this->apiRequest('/emailCampaigns', 'POST', $campaignData);
    $campaignId = $campaign['id'] ?? null;
    
    if (!$campaignId) {
      throw new \Exception('Failed to create campaign');
    }
    
    // Send the campaign immediately
    $sendResult = $this->apiRequest("/emailCampaigns/{$campaignId}/sendNow", 'POST', []);
    
    return [
      'campaignId' => $campaignId,
      'sendResult' => $sendResult
    ];
  }
  
  /**
   * Create a draft campaign that can be edited in Brevo
   */
  public function createDraftCampaign(): array
  {
    $subject = $this->generateSubject();
    $templateId = $this->kirby->option('brevo-newsletter.template_id');
    
    // If template ID is configured, use template with params
    if ($templateId) {
      // Get only the events HTML (not full email)
      $eventsHtml = $this->getEventsHtml();
      
      $campaignData = [
        'name' => 'Newsletter DRAFT - ' . date('Y-m-d H:i:s'),
        'subject' => $subject,
        'sender' => [
          'name' => $this->senderName,
          'email' => $this->senderEmail
        ],
        'templateId' => (int)$templateId,
        'params' => [
          'EVENTS_HTML' => $eventsHtml,
          'MONTH_YEAR' => date('F Y'),
          'CURRENT_YEAR' => date('Y')
        ],
        'recipients' => [
          'listIds' => $this->listIds
        ]
      ];
    } else {
      // Fallback: Create HTML campaign (old behavior)
      $htmlContent = $this->getEmailHtml();
      
      $campaignData = [
        'name' => 'Newsletter DRAFT - ' . date('Y-m-d H:i:s'),
        'subject' => $subject,
        'sender' => [
          'name' => $this->senderName,
          'email' => $this->senderEmail
        ],
        'type' => 'classic',
        'htmlContent' => $htmlContent,
        'recipients' => [
          'listIds' => $this->listIds
        ]
      ];
    }
    
    // Create the campaign (stays as draft)
    $campaign = $this->apiRequest('/emailCampaigns', 'POST', $campaignData);
    $campaignId = $campaign['id'] ?? null;
    
    if (!$campaignId) {
      throw new \Exception('Failed to create campaign');
    }
    
    // Return campaign details including edit URL
    return [
      'campaignId' => $campaignId,
      'campaignUrl' => "https://app.brevo.com/marketing-campaign/edit/{$campaignId}",
      'campaign' => $campaign,
      'usingTemplate' => (bool)$templateId
    ];
  }
  
  /**
   * Send campaign to all subscribers immediately
   */
  public function sendCampaign(): array
  {
    $htmlContent = $this->getEmailHtml();
    $subject = $this->generateSubject();
    
    // Create campaign
    $campaignData = [
      'name' => 'Newsletter - ' . date('Y-m-d H:i:s'),
      'subject' => $subject,
      'sender' => [
        'name' => $this->senderName,
        'email' => $this->senderEmail
      ],
      'type' => 'classic',
      'htmlContent' => $htmlContent,
      'recipients' => [
        'listIds' => $this->listIds
      ]
    ];
    
    // Create the campaign
    $campaign = $this->apiRequest('/emailCampaigns', 'POST', $campaignData);
    $campaignId = $campaign['id'] ?? null;
    
    if (!$campaignId) {
      throw new \Exception('Failed to create campaign');
    }
    
    // Send the campaign immediately
    $sendResult = $this->apiRequest("/emailCampaigns/{$campaignId}/sendNow", 'POST', []);
    
    return [
      'campaignId' => $campaignId,
      'sendResult' => $sendResult
    ];
  }
  
  /**
   * Schedule a campaign for a specific date/time
   */
  public function scheduleCampaign(string $scheduledAt): array
  {
    $htmlContent = $this->getEmailHtml();
    $subject = $this->generateSubject();
    
    // Create campaign
    $campaignData = [
      'name' => 'Newsletter - Scheduled ' . date('Y-m-d H:i:s'),
      'subject' => $subject,
      'sender' => [
        'name' => $this->senderName,
        'email' => $this->senderEmail
      ],
      'type' => 'classic',
      'htmlContent' => $htmlContent,
      'recipients' => [
        'listIds' => $this->listIds
      ],
      'scheduledAt' => $scheduledAt
    ];
    
    // Create and schedule the campaign
    $campaign = $this->apiRequest('/emailCampaigns', 'POST', $campaignData);
    
    return $campaign;
  }
  
  /**
   * Get the HTML content for the email
   */
  protected function getEmailHtml(): string
  {
    $eventsPage = $this->kirby->page('events');
    $today = date('Y-m-d');
    
    $events = $eventsPage
      ->children()
      ->listed()
      ->filter(function ($child) use ($today) {
        return $child->date()->value() >= $today;
      })
      ->sortBy('date', 'asc')
      ->limit(10);
    
    return $this->kirby->snippet('brevo-newsletter/email-template', [
      'events' => $events,
      'site' => $this->kirby->site(),
      'isPreview' => false
    ], true);
  }
  
  /**
   * Get just the events HTML (for templates)
   */
  protected function getEventsHtml(): string
  {
    $eventsPage = $this->kirby->page('events');
    $today = date('Y-m-d');
    
    $events = $eventsPage
      ->children()
      ->listed()
      ->filter(function ($child) use ($today) {
        return $child->date()->value() >= $today;
      })
      ->sortBy('date', 'asc')
      ->limit(10);
    
    // Return just the events section HTML
    return $this->kirby->snippet('brevo-newsletter/events-only', [
      'events' => $events,
      'site' => $this->kirby->site()
    ], true);
  }
  
  /**
   * Get events HTML for a specific month
   */
  protected function getEventsHtmlForMonth(string $monthYear): string
  {
    $eventsPage = $this->kirby->page('events');
    $startDate = "{$monthYear}-01";
    $endDate = date('Y-m-t', strtotime($startDate));
    
    $events = $eventsPage
      ->children()
      ->listed()
      ->filter(function ($child) use ($startDate, $endDate) {
        $eventDate = $child->date()->value();
        return $eventDate >= $startDate && $eventDate <= $endDate;
      })
      ->sortBy('date', 'asc');
    
    return $this->kirby->snippet('brevo-newsletter/events-only', [
      'events' => $events,
      'site' => $this->kirby->site()
    ], true);
  }
  
  /**
   * Get full email HTML with custom content
   */
  protected function getEmailHtmlWithCustomContent(
    string $welcomeText,
    string $goodbyeText,
    string $imageUrl,
    string $eventsHtml
  ): string {
    return $this->kirby->snippet('brevo-newsletter/email-template-custom', [
      'welcomeText' => $welcomeText,
      'goodbyeText' => $goodbyeText,
      'imageUrl' => $imageUrl,
      'eventsHtml' => $eventsHtml,
      'site' => $this->kirby->site()
    ], true);
  }
  
  /**
   * Generate email subject
   */
  protected function generateSubject(): string
  {
    $monthYear = date('F Y'); // e.g., "November 2025"
    return "Veranstaltungen - {$monthYear}";
  }
  
  /**
   * Get the new styled email HTML with all fields
   */
  protected function getEmailHtmlNew(array $formData): string
  {
    // Get events for the selected month
    $eventsPage = $this->kirby->page('events');
    $monthYear = $formData['monthYear'];
    $startDate = "{$monthYear}-01";
    $endDate = date('Y-m-t', strtotime($startDate));
    
    $events = $eventsPage
      ->children()
      ->listed()
      ->filter(function ($child) use ($startDate, $endDate) {
        $eventDate = $child->date()->value();
        return $eventDate >= $startDate && $eventDate <= $endDate;
      })
      ->sortBy('date', 'asc');
    
    // Get recurring events
    $recurringEventsPage = $this->kirby->site()->find('recurring-events');
    $recurringEvents = $recurringEventsPage ? $recurringEventsPage->children()->listed() : null;
    
    // Format month/year for display (e.g., "11/2025")
    list($year, $month) = explode('-', $monthYear);
    $monthYearDisplay = $month . '/' . $year;
    
    return $this->kirby->snippet('brevo-newsletter/email-template-new', [
      'events' => $events,
      'recurringEvents' => $recurringEvents,
      'site' => $this->kirby->site(),
      'welcomeTextDe' => $formData['welcomeTextDe'] ?? '',
      'welcomeTextEn' => $formData['welcomeTextEn'] ?? '',
      'goodbyeTextDe' => $formData['goodbyeTextDe'] ?? '',
      'goodbyeTextEn' => $formData['goodbyeTextEn'] ?? '',
      'imageUrl' => $formData['imageUrl'] ?? '',
      'imageCredits' => $formData['imageCredits'] ?? '',
      'monthYear' => $monthYearDisplay
    ], true);
  }
  
  /**
   * Make an API request to Brevo
   */
  protected function apiRequest(string $endpoint, string $method = 'GET', array $data = []): array
  {
    $url = self::API_BASE_URL . $endpoint;
    
    $headers = [
      'accept: application/json',
      'api-key: ' . $this->apiKey,
      'content-type: application/json'
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    if ($method === 'POST') {
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    } elseif ($method === 'PUT') {
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if (curl_errno($ch)) {
      $error = curl_error($ch);
      curl_close($ch);
      throw new \Exception('cURL error: ' . $error);
    }
    
    curl_close($ch);
    
    $result = json_decode($response, true);
    
    if ($httpCode >= 400) {
      $errorMessage = $result['message'] ?? 'API request failed';
      throw new \Exception("Brevo API error ({$httpCode}): {$errorMessage}");
    }
    
    return $result ?? [];
  }
}

