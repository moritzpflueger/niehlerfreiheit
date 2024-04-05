<?php
  $eventUrl = $event->url();
  $isValid = $event->files()->valid();
  $placeholderUrl = $site->placeholderImage()->toFile()->url();
  if ($isValid) {
    $imageUrl = $event->files()->first()->url();
    $imageAlt = $event->files()->first()->alt();
  } else {
    $imageUrl = $placeholderUrl;
    $imageAlt = 'Placeholder Image';
  };
  $highlightFeaturedEvent = $highlightFeaturedEvent ?? false;
  $showYear = $showYear ?? false;
  $showImage = $showImage ?? true;
  $showDivider = $showDivider ?? false;
?>

<article class="py-10">
  <a href="<?= $eventUrl ?>" class="flex flex-col sm:flex-row gap-10">
    <?php if ($showImage): ?>
      <div class="sm:w-1/4">
        <img src="<?= $imageUrl ?>" alt="<?= $imageAlt ?>" />
      </div>
    <?php endif; ?>
    <div class="flex-1">
      <div class="bg-pink-400 text-black text-base inline-flex px-1 -skew-x-12 ml-1 mb-3"><?= $event->category() ?></div>
      <div class="sm:text-2xl uppercase mb-2">
        <?= $event->date()->toDate('E dd MMMM' . ($showYear ? ' Y' : '')) ?>
      </div>
      <h3><?= $event->title()->html() ?></h3>
      <!-- <h2 class="text-3xl sm:text-4xl uppercase italic font-bold mb-3"><?= $event->title()->html() ?></h2> -->
      <?php if (!$event->admissiontime()->isEmpty()): ?>
        <p><?= t('event.admissionTime') . ': ' . $event->admissionTime()->toDate('HH:mm') ?></p>
      <?php endif ?>
      <p><?= t('event.startTime') . ': ' . $event->starttime()->toDate('HH:mm') ?></p>
      <!-- <p><?= $event->text()->excerpt(100) ?></p> -->
    </div>    
  </a>
</article>
<?php if ($showDivider): ?>
  <hr/>
<?php endif; ?>

<!-- bg-[#00538A] -->




