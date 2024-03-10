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
?>

<section class="my-32">
  <article class="flex flex-col gap-5">
    <a href="<?= $event->url()?>">
      <div class="">
        <p class="font-bold uppercase text-4xl mb-5">
          <?= $event->date()->toDate('E dd MMMM') ?>
        </p>
        <h2 class="text-5xl"><?= $event->title()->html() ?></h2>
      </div>
      <?php if ($event->files()->valid()): ?>
        <img 
          src="<?= $event->files()->first()->url() ?>" 
          alt="<?= $event->files()->first()->alt() ?>" 
          class="scale-110 my-10"
        >
      <?php else: ?>
        <img 
          src="<?= $site->placeholderEventImage()->toFile()->url() ?>" 
          alt="Placeholder" 
          class=""
        >
      <?php endif; ?>      
    </a>
  </article>
</section>
