<?php
  $eventUrl = $event->url();
  $isValid = $event->files()->valid();
  $placeholderUrl = $site->placeholderEventImage()->toFile()->url();
  if ($isValid) {
    $imageUrl = $event->files()->first()->url();
    $imageAlt = $event->files()->first()->alt();
  } else {
    $imageUrl = $placeholderUrl;
    $imageAlt = 'Placeholder Image';
  };
?>

<article class="mb-10">
  <a href="<?= $eventUrl ?>" class="flex flex-col sm:flex-row gap-5">
    <img 
      src="<?= $imageUrl ?>" 
      alt="<?= $imageAlt ?>" 
      class="h-32 w-32"
    >
    <div class="">
      <p class="uppercase text-xl"><?= $event->date()->toDate('EEE dd MMMM') ?></p>
      <h2 class="text-2xl font-bold"><?= $event->title()->html() ?></h2>
      <p><?= $event->description()->excerpt(100) ?></p>
    </div>    
  </a>
</article>