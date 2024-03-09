<?php
  $eventsPage = $site->find('events');
  $today = date('Y-m-d');

  // Filter for future events, sort them by date, and retrieve the first event
  $upcomingEvent = $eventsPage
    ->children()
    ->listed()
    ->filter(function($child) use ($today) {
      return $child->date()->toDate('Y-m-d') >= $today;
    })
    ->sortBy('date', 'asc')
    ->first();
?>

<section>
  <article class="mb-10 flex gap-5">
    <?php if ($upcomingEvent->files()->valid()): ?>
      <img 
        src="<?= $upcomingEvent->files()->first()->url() ?>" 
        alt="<?= $upcomingEvent->files()->first()->alt() ?>" 
        class="h-64 w-64"
      >
    <?php else: ?>
      <img 
        src="<?= $site->placeholderEventImage()->toFile()->url() ?>" 
        alt="Placeholder" 
        class="h-64 w-64"
      >
    <?php endif; ?>
    <div class="">
      <h2><?= $upcomingEvent->title()->html() ?></h2>
      <p>Date: <?= $upcomingEvent->date()->toDate('F j, Y') ?></p>
    </div>
  </article>
</section>
