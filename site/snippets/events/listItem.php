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
?>

<article class="mb-20">
  <a href="<?= $eventUrl ?>" class="flex flex-col sm:flex-row gap-10">
    <img 
      src="<?= $imageUrl ?>" 
      alt="<?= $imageAlt ?>" 
      class="w-1/3"
    >
    <div class="flex-1">
      <p class="uppercase text-xl"><?= $event->date()->toDate('EEE dd MMMM') ?></p>
      <h2 class="text-2xl font-bold"><?= $event->title()->html() ?></h2>
      <p><?= $event->text()->excerpt(100) ?></p>
    </div>    
  </a>
</article>