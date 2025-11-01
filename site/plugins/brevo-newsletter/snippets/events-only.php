<?php
/**
 * Events-only HTML snippet
 * Used for Brevo templates with {{params.EVENTS_HTML}}
 * This returns just the events section without email wrapper
 */

$imageBaseUrl = option('brevo-newsletter.image_base_url');
?>

<?php if ($events->isEmpty()): ?>
  <p style="text-align: center; padding: 40px; color: #666;">
    Zurzeit sind keine kommenden Veranstaltungen geplant.
  </p>
<?php else: ?>
  <?php foreach ($events as $index => $event): ?>
    <?php if ($index > 0): ?>
      <div style="height: 30px;"></div>
    <?php endif; ?>
    
    <table width="100%" cellpadding="0" cellspacing="0" style="border: 1px solid #e0e0e0; margin-bottom: 20px;">
      <!-- Event Image -->
      <?php 
        if ($event->files()->valid()): 
          $imageFile = $event->files()->first();
          $imageUrl = $imageFile->url();
          
          // If custom image base URL is set, use it
          if ($imageBaseUrl) {
            $imagePath = str_replace($site->url(), '', $imageUrl);
            $imageUrl = rtrim($imageBaseUrl, '/') . $imagePath;
          }
          // Otherwise ensure absolute URL
          elseif (!str_starts_with($imageUrl, 'http')) {
            $imageUrl = url($imageUrl);
          }
      ?>
        <tr>
          <td>
            <img 
              src="<?= $imageUrl ?>" 
              alt="<?= $imageFile->alt()->html() ?>"
              style="width: 100%; height: auto; display: block;">
          </td>
        </tr>
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
        <tr>
          <td>
            <img 
              src="<?= $placeholderUrl ?>" 
              alt="Event Image"
              style="width: 100%; height: auto; display: block;">
          </td>
        </tr>
      <?php endif; ?>
      
      <!-- Event Content -->
      <tr>
        <td style="padding: 20px;">
          <div>
            <span style="display: inline-block; background-color: #ffd700; color: #000000; padding: 4px 8px; font-size: 12px; font-weight: bold; text-transform: uppercase; font-family: Arial, sans-serif;">
              <?= $event->category()->html() ?>
            </span>
            <?php 
              $isCanceled = is_bool($event->isCanceled())
                ? $event->isCanceled()
                : $event->isCanceled()->toBool();
              if ($isCanceled): 
            ?>
              <span style="display: inline-block; background-color: #ff6b6b; color: #ffffff; padding: 4px 8px; font-size: 12px; font-weight: bold; margin-left: 5px; text-transform: uppercase; font-family: Arial, sans-serif;">
                Abgesagt
              </span>
            <?php endif; ?>
          </div>
          
          <h2 style="font-size: 22px; font-weight: bold; margin: 10px 0; color: #000000; font-family: Arial, sans-serif;">
            <?= $event->title()->html() ?>
          </h2>
          
          <div style="font-size: 14px; line-height: 1.8; margin: 15px 0; color: #555555; font-family: Arial, sans-serif;">
            <strong style="color: #000000;">Datum:</strong> <?= $event->date()->toDate('EEEE, dd. MMMM Y') ?><br>
            <?php if ($event->admissiontime()->isNotEmpty()): ?>
              <strong style="color: #000000;">Einlass:</strong> <?= $event->admissiontime()->toDate('H:mm') ?> Uhr<br>
            <?php endif; ?>
            <strong style="color: #000000;">Beginn:</strong> <?= $event->starttime()->toDate('H:mm') ?> Uhr
          </div>
          
          <?php if ($event->text()->isNotEmpty()): ?>
            <div style="font-size: 15px; line-height: 1.6; color: #333333; margin: 15px 0; font-family: Arial, sans-serif;">
              <?= $event->text()->excerpt(200)->html() ?>
            </div>
          <?php endif; ?>
          
          <a href="<?= $event->url() ?>" style="display: inline-block; background-color: #000000; color: #ffffff; padding: 12px 24px; text-decoration: none; font-size: 14px; font-weight: bold; margin-top: 10px; text-transform: uppercase; font-family: Arial, sans-serif;">
            Mehr erfahren
          </a>
        </td>
      </tr>
    </table>
  <?php endforeach; ?>
<?php endif; ?>

