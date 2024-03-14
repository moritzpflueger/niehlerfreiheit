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
?>

<article class="mb-20">
  <a href="<?= $eventUrl ?>" class="flex flex-col sm:flex-row gap-10">
    <div class="sm:w-1/4">
      <img src="<?= $imageUrl ?>" alt="<?= $imageAlt ?>" />
    </div>
    <div class="flex-1">
      <p class="sm:text-2xl uppercase mb-2 bg-white text-black inline-flex px-1">
        <?= $event->date()->toDate('E dd MMMM' . ($showYear ? ' Y' : '')) ?>
      </p>
      <h3><?= $event->title()->html() ?></h3>
      <p>Einlass: 19:00 Uhr</p>
      <p>Abendkasse: 15 €</p>
      <!-- <p><?= $event->text()->excerpt(100) ?></p> -->
    </div>    
  </a>
</article>

<!-- bg-[#00538A] -->




