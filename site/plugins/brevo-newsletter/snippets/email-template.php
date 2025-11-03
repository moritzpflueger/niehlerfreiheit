<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $site->title() ?> - Newsletter</title>
  <style>
    /* Email-safe CSS */
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, Helvetica, sans-serif;
      background-color: #f4f4f4;
      color: #333333;
    }
    .email-container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
    }
    .header {
      background-color: #000000;
      color: #ffffff;
      padding: 30px 20px;
      text-align: center;
    }
    .header h1 {
      margin: 0;
      font-size: 28px;
      font-weight: bold;
    }
    .header p {
      margin: 10px 0 0 0;
      font-size: 14px;
      opacity: 0.9;
    }
    .content {
      padding: 20px;
    }
    .intro {
      font-size: 16px;
      line-height: 1.6;
      margin-bottom: 30px;
      color: #333333;
    }
    .event {
      margin-bottom: 30px;
      border: 1px solid #e0e0e0;
      overflow: hidden;
    }
    .event-image {
      width: 100%;
      height: auto;
      display: block;
    }
    .event-content {
      padding: 20px;
    }
    .event-title {
      font-size: 22px;
      font-weight: bold;
      margin: 0 0 10px 0;
      color: #000000;
    }
    .event-category {
      display: inline-block;
      background-color: #ffd700;
      color: #000000;
      padding: 4px 8px;
      font-size: 12px;
      font-weight: bold;
      margin-bottom: 10px;
      text-transform: uppercase;
    }
    .event-canceled {
      display: inline-block;
      background-color: #ff6b6b;
      color: #ffffff;
      padding: 4px 8px;
      font-size: 12px;
      font-weight: bold;
      margin-left: 5px;
      text-transform: uppercase;
    }
    .event-meta {
      font-size: 14px;
      line-height: 1.8;
      margin: 15px 0;
      color: #555555;
    }
    .event-meta strong {
      color: #000000;
    }
    .event-description {
      font-size: 15px;
      line-height: 1.6;
      color: #333333;
      margin: 15px 0;
    }
    .event-link {
      display: inline-block;
      background-color: #000000;
      color: #ffffff;
      padding: 12px 24px;
      text-decoration: none;
      font-size: 14px;
      font-weight: bold;
      margin-top: 10px;
      text-transform: uppercase;
    }
    .event-link:hover {
      background-color: #333333;
    }
    .footer {
      background-color: #f8f8f8;
      padding: 30px 20px;
      text-align: center;
      font-size: 13px;
      color: #666666;
      line-height: 1.6;
    }
    .footer a {
      color: #000000;
      text-decoration: underline;
    }
    .divider {
      height: 1px;
      background-color: #e0e0e0;
      margin: 30px 0;
    }
    @media only screen and (max-width: 600px) {
      .event-title {
        font-size: 18px;
      }
      .header h1 {
        font-size: 24px;
      }
    }
  </style>
</head>
<body>
  <div class="email-container">
    <!-- Header -->
    <div class="header">
      <h1><?= $site->title()->html() ?></h1>
      <p>Veranstaltungen <?= date('F Y') ?></p>
    </div>
    
    <!-- Content -->
    <div class="content">
      <!-- ============================================ -->
      <!-- EDITOR: EDIT THIS SECTION -->
      <!-- Add your welcome text here -->
      <!-- ============================================ -->
      <div class="intro">
        <p>Hallo liebe Freund:innen,</p>
        <p>hier sind die kommenden Veranstaltungen im <?= $site->title()->html() ?>:</p>
        
        <!-- EDITOR: Add your custom text below this line -->
        <!-- Example:
        <p>Besonderer Hinweis für diesen Monat...</p>
        -->
        
        <!-- EDITOR: Add "Image of the Month" below this line -->
        <!-- Example:
        <img src="https://your-image-url.com/image.jpg" alt="Image of the Month" style="width: 100%; max-width: 600px; margin: 20px 0;">
        <p style="text-align: center; font-style: italic;">Unser Highlight im <?= date('F') ?></p>
        -->
      </div>
      <!-- ============================================ -->
      <!-- END OF EDITABLE SECTION -->
      <!-- Events below are auto-generated -->
      <!-- ============================================ -->
      
      <?php if ($events->isEmpty()): ?>
        <p>Zurzeit sind keine kommenden Veranstaltungen geplant.</p>
      <?php else: ?>
        <?php foreach ($events as $index => $event): ?>
          <?php if ($index > 0): ?>
            <div class="divider"></div>
          <?php endif; ?>
          
          <div class="event">
            <!-- Event Image -->
            <?php 
              $imageBaseUrl = option('brevo-newsletter.image_base_url');
              
              if ($event->files()->valid()): 
                $imageFile = $event->files()->first();
                $imageUrl = $imageFile->url();
                
                // If custom image base URL is set, use it (for localhost testing with production images)
                if ($imageBaseUrl) {
                  $imagePath = str_replace($site->url(), '', $imageUrl);
                  $imageUrl = rtrim($imageBaseUrl, '/') . $imagePath;
                }
                // Otherwise ensure absolute URL
                elseif (!str_starts_with($imageUrl, 'http')) {
                  $imageUrl = url($imageUrl);
                }
            ?>
              <img 
                src="<?= $imageUrl ?>" 
                alt="<?= $imageFile->alt()->html() ?>"
                class="event-image">
            <?php 
              elseif ($site->placeholderImage()->toFile()): 
                $placeholderFile = $site->placeholderImage()->toFile();
                $placeholderUrl = $placeholderFile->url();
                
                // If custom image base URL is set, use it
                if ($imageBaseUrl) {
                  $imagePath = str_replace($site->url(), '', $placeholderUrl);
                  $placeholderUrl = rtrim($imageBaseUrl, '/') . $imagePath;
                }
                // Otherwise ensure absolute URL
                elseif (!str_starts_with($placeholderUrl, 'http')) {
                  $placeholderUrl = url($placeholderUrl);
                }
            ?>
              <img 
                src="<?= $placeholderUrl ?>" 
                alt="Event Image"
                class="event-image">
            <?php endif; ?>
            
            <!-- Event Content -->
            <div class="event-content">
              <div>
                <span class="event-category"><?= $event->category()->html() ?></span>
                <?php 
                  $isCanceled = is_bool($event->isCanceled())
                    ? $event->isCanceled()
                    : $event->isCanceled()->toBool();
                  if ($isCanceled): 
                ?>
                  <span class="event-canceled">Abgesagt</span>
                <?php endif; ?>
              </div>
              
              <h2 class="event-title"><?= $event->title()->html() ?></h2>
              
              <div class="event-meta">
                <strong>Datum:</strong> <?= $event->date()->toDate('EEEE, dd. MMMM Y') ?><br>
                <?php if ($event->admissiontime()->isNotEmpty()): ?>
                  <strong>Einlass:</strong> <?= $event->admissiontime()->toDate('H:mm') ?> Uhr<br>
                <?php endif; ?>
                <strong>Beginn:</strong> <?= $event->starttime()->toDate('H:mm') ?> Uhr
              </div>
              
              <?php if ($event->text()->isNotEmpty()): ?>
                <div class="event-description">
                  <?= $event->text()->excerpt(200)->html() ?>
                </div>
              <?php endif; ?>
              
              <a href="<?= $event->url() ?>" class="event-link">Mehr erfahren</a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
      
      <div class="divider"></div>
      
      <div class="intro">
        <p>Alle Veranstaltungen findest du auch auf unserer Website:</p>
        <p><a href="<?= $site->page('events')->url() ?>" style="color: #000000; font-weight: bold;"><?= $site->page('events')->url() ?></a></p>
      </div>
    </div>
    
    <!-- Footer -->
    <div class="footer">
      <p><strong><?= $site->title()->html() ?></strong></p>
      <?php if ($site->address()->isNotEmpty()): ?>
        <p><?= $site->address()->html() ?></p>
      <?php endif; ?>
      <p>
        <a href="<?= $site->url() ?>">Website</a> | 
        <a href="<?= $site->page('impressum')->url() ?>">Impressum</a> | 
        <a href="<?= $site->page('datenschutzerklaerung')->url() ?>">Datenschutz</a>
      </p>
      <p style="font-size: 11px; color: #999999; margin-top: 20px;">
        Du erhältst diese E-Mail, weil du den Newsletter von <?= $site->title()->html() ?> abonniert hast.<br>
        {{ unsubscribe }}
      </p>
    </div>
  </div>
</body>
</html>

