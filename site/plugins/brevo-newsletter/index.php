<?php

namespace BrevoNewsletter;

use Kirby\Cms\App as Kirby;

require_once __DIR__ . '/src/BrevoClient.php';

Kirby::plugin('brevo-newsletter/integration', [
  'options' => [
    'brevo_api_key' => null,
    'sender_email' => null,
    'sender_name' => null,
    'test_email' => null,
    'list_ids' => [],
  ],
  
  
  'routes' => [
    // Panel newsletter form route
    [
      'pattern' => 'newsletter-generator',
      'method' => 'GET',
      'action' => function () {
        $kirby = kirby();
        
        // Check if user is logged in
        if (!$kirby->user()) {
          return $kirby->response()->redirect('/panel/login');
        }
        
        // Render the newsletter generator page
        ob_start();
        include __DIR__ . '/views/newsletter-generator.php';
        $html = ob_get_clean();
        
        return new \Kirby\Http\Response($html, 'text/html');
      }
    ],
    
    // API endpoint to upload newsletter image
    [
      'pattern' => 'brevo-newsletter/upload-image',
      'method' => 'POST',
      'action' => function () {
        $kirby = kirby();
        
        // Check if user is logged in
        if (!$kirby->user()) {
          return [
            'success' => false,
            'message' => 'Unauthorized'
          ];
        }
        
        // Check if file was uploaded
        if (empty($_FILES['image'])) {
          return [
            'success' => false,
            'message' => 'No file uploaded'
          ];
        }
        
        $file = $_FILES['image'];
        
        // Check for upload errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
          $errorMessages = [
            UPLOAD_ERR_INI_SIZE => 'File exceeds upload_max_filesize',
            UPLOAD_ERR_FORM_SIZE => 'File exceeds MAX_FILE_SIZE',
            UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
            UPLOAD_ERR_NO_FILE => 'No file was uploaded',
            UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
            UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
            UPLOAD_ERR_EXTENSION => 'Upload stopped by extension',
          ];
          return [
            'success' => false,
            'message' => 'Upload error: ' . ($errorMessages[$file['error']] ?? 'Unknown error: ' . $file['error'])
          ];
        }
        
        // Get file extension
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        // Debug info for troubleshooting
        $debugInfo = [
          'filename' => $file['name'],
          'extension' => $extension,
          'mime' => $file['type'],
          'size' => $file['size']
        ];
        
        // Validate file type by extension only (MIME types are unreliable)
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($extension, $allowedExtensions)) {
          return [
            'success' => false,
            'message' => 'Invalid file type. Allowed: JPG, PNG, GIF, WebP. Debug: ' . json_encode($debugInfo)
          ];
        }
        
        // Skip MIME type validation entirely - extension check is sufficient
        
        // Validate file size (max 5MB)
        if ($file['size'] > 5 * 1024 * 1024) {
          return [
            'success' => false,
            'message' => 'File too large. Maximum size is 5MB.'
          ];
        }
        
        try {
          // Create pictures-of-the-month directory if it doesn't exist
          $uploadDir = $kirby->root('assets') . '/pictures-of-the-month';
          if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
          }
          
          // Generate unique filename
          $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
          $filename = date('Y-m-d_His') . '_' . uniqid() . '.' . $extension;
          $uploadPath = $uploadDir . '/' . $filename;
          
          // Move uploaded file
          if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
            throw new \Exception('Failed to save file');
          }
          
          // Get base URL
          $baseUrl = $kirby->url();
          if (option('brevo-newsletter.image_base_url')) {
            $baseUrl = option('brevo-newsletter.image_base_url');
          }
          
          // Return the URL
          $imageUrl = $baseUrl . '/assets/pictures-of-the-month/' . $filename;
          
          return [
            'success' => true,
            'url' => $imageUrl,
            'filename' => $filename
          ];
          
        } catch (\Exception $e) {
          return [
            'success' => false,
            'message' => 'Upload failed: ' . $e->getMessage()
          ];
        }
      }
    ],
    
    // API endpoint to get events for a specific month
    [
      'pattern' => 'brevo-newsletter/events/(:any)/(:any)',
      'method' => 'GET',
      'action' => function ($year, $month) {
        $kirby = kirby();
        
        // Check if user is logged in
        if (!$kirby->user()) {
          return [
            'success' => false,
            'message' => 'Unauthorized'
          ];
        }
        
        $eventsPage = $kirby->page('events');
        $startDate = "{$year}-{$month}-01";
        $endDate = date('Y-m-t', strtotime($startDate));
        
        $events = $eventsPage
          ->children()
          ->listed()
          ->filter(function ($child) use ($startDate, $endDate) {
            $eventDate = $child->date()->value();
            return $eventDate >= $startDate && $eventDate <= $endDate;
          })
          ->sortBy('date', 'asc');
        
        $eventsList = [];
        foreach ($events as $event) {
          $eventsList[] = [
            'id' => $event->id(),
            'title' => $event->title()->html(),
            'date' => $event->date()->toDate('dd.MM.Y'),
            'category' => $event->category()->html(),
            'isRecurring' => false
          ];
        }
        
        // Get recurring events
        $recurringEventsPage = $kirby->site()->find('recurring-events');
        if ($recurringEventsPage) {
          $recurringEvents = $recurringEventsPage->children()->listed();
          
          foreach ($recurringEvents as $event) {
            $eventsList[] = [
              'id' => $event->id(),
              'title' => $event->title()->html(),
              'date' => 'Wiederkehrend',
              'category' => $event->category()->html(),
              'isRecurring' => true
            ];
          }
        }
        
        return [
          'success' => true,
          'events' => $eventsList
        ];
      }
    ],
    
    // API endpoint to create draft from form
    [
      'pattern' => 'brevo-newsletter/create-draft-form',
      'method' => 'POST',
      'action' => function () {
        $kirby = kirby();
        
        // Check if user is logged in
        if (!$kirby->user()) {
          return [
            'success' => false,
            'message' => 'Unauthorized'
          ];
        }
        
        $data = $kirby->request()->data();
        
        try {
          $brevoClient = new BrevoClient($kirby);
          $result = $brevoClient->createDraftFromForm($data);
          
          return [
            'success' => true,
            'message' => 'Draft campaign created in Brevo',
            'data' => $result
          ];
        } catch (\Exception $e) {
          return [
            'success' => false,
            'message' => $e->getMessage()
          ];
        }
      }
    ],
    
    // API endpoint to send now from form
    [
      'pattern' => 'brevo-newsletter/send-now-form',
      'method' => 'POST',
      'action' => function () {
        $kirby = kirby();
        
        // Check if user is logged in and is admin
        if (!$kirby->user() || !$kirby->user()->isAdmin()) {
          return [
            'success' => false,
            'message' => 'Unauthorized - Admin access required'
          ];
        }
        
        $data = $kirby->request()->data();
        
        try {
          $brevoClient = new BrevoClient($kirby);
          $result = $brevoClient->sendCampaignFromForm($data);
          
          return [
            'success' => true,
            'message' => 'Campaign sent successfully',
            'data' => $result
          ];
        } catch (\Exception $e) {
          return [
            'success' => false,
            'message' => $e->getMessage()
          ];
        }
      }
    ],
    
    
    // Admin preview route (old, keep for backwards compatibility)
    [
      'pattern' => 'brevo-newsletter/preview',
      'method' => 'GET',
      'action' => function () {
        $kirby = kirby();
        
        // Check if user is logged in
        if (!$kirby->user()) {
          return $kirby->response()->redirect('/panel/login');
        }
        
        // Get upcoming events
        $eventsPage = $kirby->page('events');
        $today = date('Y-m-d');
        
        $events = $eventsPage
          ->children()
          ->listed()
          ->filter(function ($child) use ($today) {
            return $child->date()->value() >= $today;
          })
          ->sortBy('date', 'asc')
          ->limit(10);
        
        // Render the email template
        $html = $kirby->snippet('brevo-newsletter/email-template', [
          'events' => $events,
          'site' => $kirby->site(),
          'isPreview' => true
        ], true);
        
        // Return preview page with controls
        return $kirby->snippet('brevo-newsletter/preview-page', [
          'emailHtml' => $html,
          'events' => $events
        ], true);
      }
    ],
    
    // API endpoint to create draft campaign
    [
      'pattern' => 'brevo-newsletter/create-draft',
      'method' => 'POST',
      'action' => function () {
        $kirby = kirby();
        
        // Check if user is logged in
        if (!$kirby->user()) {
          return [
            'success' => false,
            'message' => 'Unauthorized'
          ];
        }
        
        try {
          $brevoClient = new BrevoClient($kirby);
          $result = $brevoClient->createDraftCampaign();
          
          return [
            'success' => true,
            'message' => 'Draft campaign created in Brevo',
            'data' => $result
          ];
        } catch (\Exception $e) {
          return [
            'success' => false,
            'message' => $e->getMessage()
          ];
        }
      }
    ],
    
    // API endpoint to send test email
    [
      'pattern' => 'brevo-newsletter/send-test',
      'method' => 'POST',
      'action' => function () {
        $kirby = kirby();
        
        // Check if user is logged in
        if (!$kirby->user()) {
          return [
            'success' => false,
            'message' => 'Unauthorized'
          ];
        }
        
        $testEmail = $kirby->option('brevo-newsletter.test_email');
        if (!$testEmail) {
          return [
            'success' => false,
            'message' => 'Test email not configured in config.php'
          ];
        }
        
        try {
          $brevoClient = new BrevoClient($kirby);
          $result = $brevoClient->sendTestEmail($testEmail);
          
          return [
            'success' => true,
            'message' => 'Test email sent to ' . $testEmail,
            'data' => $result
          ];
        } catch (\Exception $e) {
          return [
            'success' => false,
            'message' => $e->getMessage()
          ];
        }
      }
    ],
    
    // API endpoint to send campaign now
    [
      'pattern' => 'brevo-newsletter/send-now',
      'method' => 'POST',
      'action' => function () {
        $kirby = kirby();
        
        // Check if user is logged in and is admin
        if (!$kirby->user() || !$kirby->user()->isAdmin()) {
          return [
            'success' => false,
            'message' => 'Unauthorized - Admin access required'
          ];
        }
        
        try {
          $brevoClient = new BrevoClient($kirby);
          $result = $brevoClient->sendCampaign();
          
          return [
            'success' => true,
            'message' => 'Campaign sent successfully',
            'data' => $result
          ];
        } catch (\Exception $e) {
          return [
            'success' => false,
            'message' => $e->getMessage()
          ];
        }
      }
    ],
    
    // API endpoint to schedule campaign
    [
      'pattern' => 'brevo-newsletter/schedule',
      'method' => 'POST',
      'action' => function () {
        $kirby = kirby();
        
        // Check if user is logged in and is admin
        if (!$kirby->user() || !$kirby->user()->isAdmin()) {
          return [
            'success' => false,
            'message' => 'Unauthorized - Admin access required'
          ];
        }
        
        $data = $kirby->request()->data();
        $scheduledAt = $data['scheduledAt'] ?? null;
        
        if (!$scheduledAt) {
          return [
            'success' => false,
            'message' => 'scheduledAt parameter required (ISO 8601 format)'
          ];
        }
        
        try {
          $brevoClient = new BrevoClient($kirby);
          $result = $brevoClient->scheduleCampaign($scheduledAt);
          
          return [
            'success' => true,
            'message' => 'Campaign scheduled for ' . $scheduledAt,
            'data' => $result
          ];
        } catch (\Exception $e) {
          return [
            'success' => false,
            'message' => $e->getMessage()
          ];
        }
      }
    ]
  ],
  
  'snippets' => [
    'brevo-newsletter/email-template' => __DIR__ . '/snippets/email-template.php',
    'brevo-newsletter/email-template-custom' => __DIR__ . '/snippets/email-template-custom.php',
    'brevo-newsletter/email-template-new' => __DIR__ . '/snippets/email-template-new.php',
    'brevo-newsletter/events-only' => __DIR__ . '/snippets/events-only.php',
    'brevo-newsletter/preview-page' => __DIR__ . '/snippets/preview-page.php',
    'brevo-newsletter/newsletter-form' => __DIR__ . '/views/newsletter-form.php',
  ],
  
]);

