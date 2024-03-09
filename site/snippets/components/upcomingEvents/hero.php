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

<section class="my-32">
  <article class="flex flex-col gap-5">
    <div class="">
      <p class="font-bold text-4xl mb-5"><?= date('D j M', strtotime($upcomingEvent->date())) ?></p>
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
