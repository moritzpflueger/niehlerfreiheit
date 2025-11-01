<?php
/**
 * New Email Template for Niehler Freiheit Newsletter
 * 
 * Variables:
 * - $events: Collection of event pages
 * - $site: Site object
 * - $welcomeTextDe: German welcome text
 * - $welcomeTextEn: English welcome text
 * - $goodbyeTextDe: German goodbye text
 * - $goodbyeTextEn: English goodbye text
 * - $imageUrl: Optional image URL
 * - $monthYear: Month/Year for title (e.g., "11/2025")
 */

// Brand colors for events
$brandColors = [
  '#ca1cff', // Pink
  '#ffb61c', // Yellow
  '#783f5a', // Brown
  '#78ccce', // Light Blue
  '#1e7b7b', // Teal
  '#9fa5f0', // Lavender
  '#5a746b', // Green
];

// Get base URL for images
$baseUrl = $site->url();
if (option('brevo-newsletter.image_base_url')) {
  $baseUrl = option('brevo-newsletter.image_base_url');
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Newsletter - Niehler Freiheit</title>
  <style>
    body {
      margin: 0;
      padding: 0 30px;
      font-family: Arial, Helvetica, sans-serif;
      background-color: #ffffff;
      color: #000000;
      line-height: 1.6;
    }
    
    .container {
      max-width: 600px;
      margin: 0 auto;
    }
    
    .header {
      padding: 15px 0;
      text-align: left;
    }
    
    .header h1 {
      margin: 0;
      font-size: 32px;
      font-weight: bold;
    }
    
    .header .month {
      margin-top: 5px;
      font-size: 32px;
      font-weight: bold;
    }
    
    .event-list-sidebar {
      text-align: right;
      margin-bottom: 20px;
    }
    
    .event-list-table {
      margin-left: auto;
      border-collapse: collapse;
    }
    
    .event-list-item {
      padding: 0 5px;
      font-size: 19px;      
      text-align: right;
      color: #ffffff;
      line-height: 1.1;
      display: inline-block;
    }
    
    .welcome-section {
      padding: 40px 0;
    }
    
    .welcome-text {
      font-size: 14px;
      line-height: 1.8;
      margin-bottom: 15px;
    }
    
    .welcome-text-en {
      font-style: italic;
    }
    
    .image-section {
      padding: 30px 0;
      border-top: 2px solid #000000;
    }
    
    .image-section img {
      width: 100%;
      height: auto;
      display: block;
      margin-bottom: 10px;
    }
    
    .image-credits {
      font-size: 14px;
    }
    
    .event {
      padding: 30px 0;
      border-top: 2px solid #000000;
    }
    
    .event-image {
      width: 100%;
      height: auto;
      display: block;
      margin-bottom: 20px;
    }
    
    .event-title {
      display: inline-block;
      padding: 0 5px;
      margin-bottom: 15px;
      color: #ffffff;
      font-size: 19px;
      text-align: left;
      line-height: 1.1;
    }

    .event-title-en {
      font-style: italic;
    }
    
    .event-content {
      padding: 0;
    }
    
    .event-content-en {
      font-style: italic;
    }
    
    .event-meta {
      font-weight: bold;
      font-size: 14px;
      line-height: 1.8;
      margin-bottom: 20px;
    }
    
    .event-description {
      font-size: 14px;
      line-height: 1.8;
      margin-bottom: 30px;
    }
    
    .goodbye-section {
      padding: 40px 0;
    }
    
    .goodbye-text {
      font-size: 14px;
      line-height: 1.8;
      margin-bottom: 15px;
    }
    
    .unsubscribe-section {
      padding: 30px 0;
      text-align: center;
      font-size: 12px;
      color: #666;
    }
    
    .unsubscribe-section a {
      text-decoration: underline;
    }
    
    .footer {
      padding: 30px;
      text-align: center;
      font-size: 14px;
      background-color: #eff2f7;
      color: #3b3f44;
    }
    
    /* Mobile responsiveness */
    @media only screen and (max-width: 600px) {
      .header h1,
      .header .month {
        font-size: 24px;
      }
      
      .event-list-item {
        font-size: 16px;
      }
      
      .event-title {
        font-size: 17px;
      }
      
      .welcome-section, .goodbye-section {
        padding: 20px 0;
      }
      
      .event-content {
        padding: 0;
      }
      
      .unsubscribe-section {
        padding: 20px 0;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Header -->
    <div class="header">
      <h1>@Niehler Freiheit</h1>
      <div class="month"><?= $monthYear ?></div>
    </div>
    
    <!-- Event List Sidebar -->
    <div class="event-list-sidebar">
      <table class="event-list-table" cellpadding="0" cellspacing="0" border="0">
        <?php 
        $colorIndex = 0;
        foreach ($events as $event): 
          $color = $brandColors[$colorIndex % count($brandColors)];
          $colorIndex++;
        ?>
          <tr>
            <td style="padding-bottom: 5px;">
              <div class="event-list-item" style="background-color: <?= $color ?>">
                <?= $event->title()->html() ?>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
        
        <?php if ($recurringEvents && $recurringEvents->isNotEmpty()): ?>
          <?php foreach ($recurringEvents as $event): 
            $color = $brandColors[$colorIndex % count($brandColors)];
            $colorIndex++;
          ?>
            <tr>
              <td style="padding-bottom: 5px;">
                <div class="event-list-item" style="background-color: <?= $color ?>">
                  <?= $event->title()->html() ?>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
        
        <!-- Static donation event (always appears at the bottom) -->
        <tr>
          <td style="padding-bottom: 5px;">
            <div class="event-list-item" style="background-color: #df5348;">
              In eigener Sache
            </div>
          </td>
        </tr>
      </table>
    </div>
    
    <!-- Welcome Text -->
    <div class="welcome-section">
      <div class="welcome-text"><?= nl2br(html($welcomeTextDe)) ?></div>
      <div class="welcome-text welcome-text-en"><?= nl2br(html($welcomeTextEn)) ?></div>
    </div>
    
    <!-- Events -->
    <?php 
    $colorIndex = 0;
    foreach ($events as $event): 
      $color = $brandColors[$colorIndex % count($brandColors)];
      $colorIndex++;
      
      // Get event image
      $eventImage = $event->files()->first();
      $eventImageUrl = $eventImage ? $eventImage->url() : '';
      if ($eventImageUrl && !str_starts_with($eventImageUrl, 'http')) {
        $eventImageUrl = $baseUrl . $eventImageUrl;
      }
      
      // Format dates
      $date = strtotime($event->date()->value());
      
      // German date formatting
      $daysDe = ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'];
      $monthsDe = ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'];
      $dayDe = $daysDe[date('w', $date)];
      $dayNum = date('j', $date);
      $monthDe = $monthsDe[date('n', $date) - 1];
      $yearNum = date('Y', $date);
      $dateFormatDe = "{$dayDe}, {$dayNum}. {$monthDe} {$yearNum}";
      
      // English date formatting
      $dateFormatEn = date('l, F j, Y', $date);
      
      // Get times
      $admissionTime = $event->admissiontime()->isNotEmpty() ? $event->admissiontime()->value() : '';
      $startTime = $event->starttime()->isNotEmpty() ? $event->starttime()->value() : '';
      
      // Format times (remove seconds)
      if ($admissionTime) {
        $admissionTime = substr($admissionTime, 0, 5);
      }
      if ($startTime) {
        $startTime = substr($startTime, 0, 5);
      }
    ?>
    <div class="event">
      <!-- Event Image -->
      <?php if ($eventImageUrl): ?>
      <img src="<?= $eventImageUrl ?>" alt="<?= $event->title()->html() ?>" class="event-image">
      <?php endif; ?>
      
      <!-- Event Title (German) -->
      <div class="event-title" style="background-color: <?= $color ?>;">
        <?= $event->title()->html() ?>
      </div>
      
      <!-- Event Content (German) -->
      <div class="event-content">
        <div class="event-meta">
          <?= ucfirst($dateFormatDe) ?><br>
          <?php if ($admissionTime): ?>Einlass: <?= $admissionTime ?><br><?php endif; ?>
          <?php if ($startTime): ?>Beginn: <?= $startTime ?><?php endif; ?>
        </div>
        
        <div class="event-description">
          <?= $event->text()->kirbytext() ?>
        </div>
      </div>
      
      <!-- Event Title (English) -->
      <div class="event-title event-title-en" style="background-color: <?= $color ?>;">
        <?= $event->title()->html() ?>
      </div>
      
      <!-- Event Content (English) -->
      <div class="event-content event-content-en">
        <div class="event-meta">
          <?= $dateFormatEn ?><br>
          <?php if ($admissionTime): ?>Admission: <?= $admissionTime ?><br><?php endif; ?>
          <?php if ($startTime): ?>Start: <?= $startTime ?><?php endif; ?>
        </div>
        
        <?php if ($event->content('en')->text()->isNotEmpty()): ?>
        <div class="event-description">
          <?= $event->content('en')->text()->kirbytext() ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
    <?php endforeach; ?>

    <!-- Recurring Events -->
    <?php if ($recurringEvents && $recurringEvents->isNotEmpty()): ?>
      <?php 
      // Continue color index from regular events
      foreach ($recurringEvents as $event): 
        $color = $brandColors[$colorIndex % count($brandColors)];
        $colorIndex++;
        
        // Get event image
        $eventImage = $event->files()->first();
        $eventImageUrl = $eventImage ? $eventImage->url() : '';
        if ($eventImageUrl && !str_starts_with($eventImageUrl, 'http')) {
          $eventImageUrl = $baseUrl . $eventImageUrl;
        }
        
        // Get times
        $admissionTime = $event->admissiontime()->isNotEmpty() ? $event->admissiontime()->value() : '';
        $startTime = $event->starttime()->isNotEmpty() ? $event->starttime()->value() : '';
        
        // Format times (remove seconds)
        if ($admissionTime) {
          $admissionTime = substr($admissionTime, 0, 5);
        }
        if ($startTime) {
          $startTime = substr($startTime, 0, 5);
        }
        
        // Build recurrence text
        $recurrence = $event->recurrence()->value();
        $recurrenceDays = $event->recurrenceDays()->value();
        $weekOfMonth = $event->weekOfMonth()->value();
        $isBiweekly = $event->isBiweekly()->toBool();
        
        // German day names
        $dayNamesDe = [
          'MO' => 'Montag',
          'TU' => 'Dienstag',
          'WE' => 'Mittwoch',
          'TH' => 'Donnerstag',
          'FR' => 'Freitag',
          'SA' => 'Samstag',
          'SU' => 'Sonntag'
        ];
        
        // English day names
        $dayNamesEn = [
          'MO' => 'Monday',
          'TU' => 'Tuesday',
          'WE' => 'Wednesday',
          'TH' => 'Thursday',
          'FR' => 'Friday',
          'SA' => 'Saturday',
          'SU' => 'Sunday'
        ];
        
        // Week position names (lowercase for German "im Monat" usage)
        $weekPositionDe = ['1' => 'ersten', '2' => 'zweiten', '3' => 'dritten', '4' => 'vierten', '5' => 'fünften'];
        $weekPositionEn = ['1' => 'first', '2' => 'second', '3' => 'third', '4' => 'fourth', '5' => 'fifth'];
        
        $recurrenceTextDe = '';
        $recurrenceTextEn = '';
        
        if ($recurrence === 'weekly') {
          $days = explode(',', $recurrenceDays);
          $daysDe = array_map(function($d) use ($dayNamesDe) { return $dayNamesDe[trim($d)] ?? trim($d); }, $days);
          $daysEn = array_map(function($d) use ($dayNamesEn) { return $dayNamesEn[trim($d)] ?? trim($d); }, $days);
          
          if ($isBiweekly) {
            if (count($days) == 1) {
              $recurrenceTextDe = 'Jeder zweite ' . $daysDe[0];
              $recurrenceTextEn = 'Every second ' . $daysEn[0];
            } else {
              $recurrenceTextDe = 'Alle zwei Wochen, ' . implode(', ', $daysDe);
              $recurrenceTextEn = 'Every two weeks, ' . implode(', ', $daysEn);
            }
          } else {
            if (count($days) == 1) {
              $recurrenceTextDe = 'Jeden ' . $daysDe[0];
              $recurrenceTextEn = 'Every ' . $daysEn[0];
            } else {
              $recurrenceTextDe = 'Jede Woche, ' . implode(', ', $daysDe);
              $recurrenceTextEn = 'Every week, ' . implode(', ', $daysEn);
            }
          }
        } elseif ($recurrence === 'monthly') {
          $weeks = explode(',', $weekOfMonth);
          $days = explode(',', $recurrenceDays);
          
          $weeksDe = array_map(function($w) use ($weekPositionDe) { return $weekPositionDe[trim($w)] ?? trim($w); }, $weeks);
          $weeksEn = array_map(function($w) use ($weekPositionEn) { return $weekPositionEn[trim($w)] ?? trim($w); }, $weeks);
          
          $daysDe = array_map(function($d) use ($dayNamesDe) { return $dayNamesDe[trim($d)] ?? trim($d); }, $days);
          $daysEn = array_map(function($d) use ($dayNamesEn) { return $dayNamesEn[trim($d)] ?? trim($d); }, $days);
          
          // Build natural language text
          if (count($weeks) == 1 && count($days) == 1) {
            // Single occurrence: "Jeder zweite Sonntag im Monat"
            $recurrenceTextDe = 'Jeder ' . $weeksDe[0] . ' ' . $daysDe[0] . ' im Monat';
            $recurrenceTextEn = 'Every ' . $weeksEn[0] . ' ' . $daysEn[0] . ' of the month';
          } else {
            // Multiple occurrences: fallback to list format
            $recurrenceTextDe = 'Jeder ' . implode('/', $weeksDe) . ' ' . implode(', ', $daysDe) . ' im Monat';
            $recurrenceTextEn = 'Every ' . implode('/', $weeksEn) . ' ' . implode(', ', $daysEn) . ' of the month';
          }
        }
      ?>
      <div class="event">
        <!-- Event Image -->
        <?php if ($eventImageUrl): ?>
        <img src="<?= $eventImageUrl ?>" alt="<?= $event->title()->html() ?>" class="event-image">
        <?php endif; ?>
        
        <!-- Event Title (German) -->
        <div class="event-title" style="background-color: <?= $color ?>;">
          <?= $event->title()->html() ?>
        </div>
        
        <!-- Event Content (German) -->
        <div class="event-content">
          <div class="event-meta">
            <?= $recurrenceTextDe ?><br>
            <?php if ($admissionTime): ?>Einlass: <?= $admissionTime ?><br><?php endif; ?>
            <?php if ($startTime): ?>Beginn: <?= $startTime ?><?php endif; ?>
          </div>
          
          <div class="event-description">
            <?= $event->text()->kirbytext() ?>
            <?php 
            $category = strtolower($event->category()->value());
            $categoryUrl = "https://niehlerfreiheit.de/de/events?category=" . urlencode($category);
            ?>
            <p style="margin-top: 15px; font-size: 14px;">
              Bitte prüfe unsere Website für aktuelle <a href="<?= $categoryUrl ?>" style="color: #0000ff; text-decoration: underline;">Termine</a> und mögliche Absagen.
            </p>
          </div>
        </div>
        
        <!-- Event Title (English) -->
        <div class="event-title event-title-en" style="background-color: <?= $color ?>;">
          <?= $event->title()->html() ?>
        </div>
        
        <!-- Event Content (English) -->
        <div class="event-content event-content-en">
          <div class="event-meta">
            <?= $recurrenceTextEn ?><br>
            <?php if ($admissionTime): ?>Admission: <?= $admissionTime ?><br><?php endif; ?>
            <?php if ($startTime): ?>Start: <?= $startTime ?><?php endif; ?>
          </div>
          
          <?php if ($event->content('en')->text()->isNotEmpty()): ?>
          <div class="event-description">
            <?= $event->content('en')->text()->kirbytext() ?>
            <?php 
            $category = strtolower($event->category()->value());
            $categoryUrlEn = "https://niehlerfreiheit.de/en/events?category=" . urlencode($category);
            ?>
            <p style="margin-top: 15px; font-size: 14px;">
              Please check our website for current <a href="<?= $categoryUrlEn ?>" style="color: #0000ff; text-decoration: underline;">dates</a> and possible cancellations.
            </p>
          </div>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>

    <!-- ============================================ -->
    <!-- STATIC DONATION EVENT (always at the bottom) -->
    <!-- ============================================ -->
    <!-- This is a hardcoded event that appears in every newsletter -->
    <!-- Color: #df5348 (Salmon Red) -->
    <!-- To modify: Edit the text content below -->
    <!-- Image: /assets/images/in-eigener-sache.png -->
    <div class="event">
      <!-- Event Image -->
      <?php 
      // Use base URL without language prefix for static image
      $staticImageUrl = preg_replace('#/(de|en)$#', '', $baseUrl) . '/assets/images/in-eigener-sache.png';
      ?>
      <img src="<?= $staticImageUrl ?>" alt="In eigener Sache" class="event-image">
      
      <!-- Event Title (German) -->
      <div class="event-title" style="background-color: #df5348;">
        In eigener Sache
      </div>
      
      <!-- Event Content (German) -->
      <div class="event-content">
        <div class="event-description">
          <p>Die Niehler Freiheit versteht sich als nicht-kommerzieller Freiraum, in welchem ein vielfältiges Kulturangebot abseits wirtschaftlicher Zwänge realisiert wird.</p>
          
          <p>Konkret bedeutet dies für uns, dass wir Projekte und Veranstaltungen nicht nach finanziellen Kriterien auswählen.</p>
          
          <p>Somit können wir auch kleinen Projekten und ungewöhnlichen Ideen einen Raum zur Darstellung und Begegnung ermöglichen. Zudem ist unser Programm nicht an feste Eintrittsgelder geknüpft. Ein Grundprinzip der Niehler Freiheit ist, dass Kulturangebote auf Spendenbasis stattfinden, sodass der Zugang möglichst allen Besucher*innen – unabhängig ihrer finanziellen Situation – ermöglicht wird.</p>
          
          <p>Damit die Niehler Freiheit auch weiterhin in diesem Sinne existieren kann, sind wir auf finanzielle Unterstützung angewiesen. Besonders regelmäßige Spenden in Form von festen monatlichen Beiträgen helfen uns, dauerhaft planen und kalkulieren zu können. Wir freuen uns auf deine Unterstützung!</p>
          
          <p><strong>Unser Spendenformular findet ihr hier:</strong><br>
          <a href="https://niehlerfreiheit.de/unterstuetzung.html" style="color: #0000ff; text-decoration: underline;">https://niehlerfreiheit.de/unterstuetzung.html</a></p>
        </div>
      </div>
      
      <!-- Event Title (English) -->
      <div class="event-title event-title-en" style="background-color: #df5348;">
        Speaking of Niehler Freiheit
      </div>
      
      <!-- Event Content (English) -->
      <div class="event-content event-content-en">
        <div class="event-description">
          <p>Niehler Freiheit understands itself as a non-commercial, open space in which a diverse range of cultural events can be realized without economic constraints. Precisely, this means that we do not select projects and events according to financial benefit they bring to us. Thus, we can also offer the stage to small projects and unusual ideas.</p>
          
          <p>In addition, our program is not tied to fixed admission fees. A basic principle of Niehler Freiheit is that cultural events take place donation based, making them accessible for as many visitors as possible - regardless of their financial situation.</p>
          
          <p>In order for Niehler Freiheit to further exist in this manner, we are dependent on financial support. Especially regular donations as fixed monthly contributions help us planning and calculating on a long-term basis. We look forward to your support!</p>
          
          <p><strong>You can find our donation form here:</strong><br>
          <a href="https://niehlerfreiheit.de/unterstuetzung.html" style="color: #0000ff; text-decoration: underline;">https://niehlerfreiheit.de/unterstuetzung.html</a></p>
        </div>
      </div>
    </div>
    <!-- END OF STATIC DONATION EVENT -->

    <!-- Image of the Month (if provided) -->
    <?php if (!empty($imageUrl)): ?>
    <div class="image-section">
      <img src="<?= $imageUrl ?>" alt="Image of the month">
      <p style="font-size: 19px; font-style: italic; font-weight: bold;">Picture of the Month</p>
      <?php if (!empty($imageCredits)): ?>
      <div class="image-credits"><?= nl2br(html($imageCredits)) ?></div>
      <?php endif; ?>
    </div>
    <?php endif; ?>
    
    <!-- Footer -->
    <div class="footer">
      <p style="font-weight: bold; font-size: 19px; margin-bottom: 5px;">Niehler Freiheit e.V.</p>
      <p style="margin-top: 0;">Vogelsanger Str. 385b, 50827 Köln</p>
      <p style="margin-bottom: 0;">Diese E-mail wurde an {{contact.EMAIL}} gesendet.</p>
      <p style="margin-top: 0;">Sie haben die E-mail erhalten, weil Sie sich für den Newsletter angemeldet haben.</p>
      <div class="unsubscribe-section">
        <p>
          <a href="{{ unsubscribe }}">Hier abmelden</a>
        </p>
        <p style="margin-top: 5px; font-style: italic;">        
          <a href="{{ unsubscribe }}">Unsubscribe here</a>
        </p>
      </div>
    </div>
  </div>
</body>
</html>

