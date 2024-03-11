<?php
  $eventsPage = $site->find('events');
  $today = date('Y-m-d');
  // Filter for future events, sort them by date, and retrieve the first event
  $event = $eventsPage
    ->children()
    ->listed()
    ->filter(function($child) use ($today) {
      return $child->date()->toDate('YYYY-MM-dd') >= $today;
    })
    ->sortBy('date', 'asc')
    ->first();

  if (!$event) return;

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

<section class="my-32">
  <article class="flex flex-col gap-5">
    <a href="<?= $eventUrl?>">
      <div class="">
        <p class="font-bold uppercase text-4xl mb-5">
          <?= $event->date()->toDate('E dd MMMM') ?>
        </p>
        <h2 class="text-5xl"><?= $event->title()->html() ?></h2>
      </div>
      <img 
        src="<?= $imageUrl ?>" 
        alt="<?= $imageAlt ?>" 
        class="my-10"
      >
      <p><?= $event->description()->excerpt(200) ?></p>
    </a>
  </article>
</section>
