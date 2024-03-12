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
  $showYear = $showYear ?? false;
?>

<article class="mb-20">
  <a href="<?= $eventUrl ?>" class="flex flex-col sm:flex-row gap-10">
    <div class="w-1/4">
      <img src="<?= $imageUrl ?>" alt="<?= $imageAlt ?>" />
    </div>
    <div class="flex-1">
      <p class="text-xl uppercase mb-3"><?= $event->date()->toDate($showYear ? 'EEE dd MMMM Y' : 'EEE dd MMMM') ?></p>
      <h2 class="text-5xl uppercase font-bold mb-3"><?= $event->title()->html() ?></h2>
      <p>Einlass: 19:00 Uhr</p>
      <p>Abendkasse: 15 €</p>
      <!-- <p><?= $event->text()->excerpt(100) ?></p> -->
    </div>    
  </a>
</article>