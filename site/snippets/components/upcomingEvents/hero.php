<?php
  $eventsPage = $site->find('events');
  $today = date('Y-m-d');

  // Filter for future events, sort them by date, and retrieve the first event
  $upcomingEvent = $eventsPage
    ->children()
    ->listed()
    ->filter(function($child) use ($today) {
      return $child->date()->toDate('YYYY-MM-dd') >= $today;
    })
    ->sortBy('date', 'asc')
    ->first();

  if (!$upcomingEvent) return;
?>

<section class="my-32">
  <article class="flex flex-col gap-5">
    <div class="">
      <p class="font-bold uppercase text-4xl mb-5">
        <?= $upcomingEvent->date()->toDate('E dd MMMM') ?>
      </p>
      <h2 class="text-5xl"><?= $upcomingEvent->title()->html() ?></h2>
    </div>
    <?php if ($upcomingEvent->files()->valid()): ?>
      <img 
        src="<?= $upcomingEvent->files()->first()->url() ?>" 
        alt="<?= $upcomingEvent->files()->first()->alt() ?>" 
        class="scale-110 my-10"
      >
    <?php else: ?>
      <img 
        src="<?= $site->placeholderEventImage()->toFile()->url() ?>" 
        alt="Placeholder" 
        class=""
      >
    <?php endif; ?>
  </article>
</section>
