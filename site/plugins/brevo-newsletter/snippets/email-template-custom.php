<?php
/**
 * Custom email template with welcome/goodbye text and optional image
 * Used when generating from panel form
 */
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $site->title() ?> - Newsletter</title>
  <style>
    /* Reuse styles from email-template.php */
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
      white-space: pre-wrap;
    }
    .image-of-month {
      width: 100%;
      max-width: 600px;
      height: auto;
      margin: 30px 0;
      border-radius: 8px;
    }
    .goodbye {
      font-size: 16px;
      line-height: 1.6;
      margin-top: 30px;
      color: #333333;
      white-space: pre-wrap;
    }
    .divider {
      height: 1px;
      background-color: #e0e0e0;
      margin: 30px 0;
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
      <!-- Welcome Text -->
      <?php if (!empty($welcomeText)): ?>
        <div class="intro">
          <?= nl2br(htmlspecialchars($welcomeText)) ?>
        </div>
      <?php endif; ?>
      
      <!-- Image of Month -->
      <?php if (!empty($imageUrl)): ?>
        <img src="<?= htmlspecialchars($imageUrl) ?>" alt="Bild des Monats" class="image-of-month">
      <?php endif; ?>
      
      <!-- Events Section -->
      <?= $eventsHtml ?>
      
      <!-- Goodbye Text -->
      <?php if (!empty($goodbyeText)): ?>
        <div class="divider"></div>
        <div class="goodbye">
          <?= nl2br(htmlspecialchars($goodbyeText)) ?>
        </div>
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

