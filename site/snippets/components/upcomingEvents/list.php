<?php
  $rows = $rows ?? 3;
  $hideFirstEvent = $hideFirstEvent ?? false;
  $groupByMonth = $groupByMonth ?? false;
  if ($hideFirstEvent) $rows++;

  $eventsPage = $site->find('events');
  $today = date('Y-m-d');

  // Filter for future events, sort them by date, and limit to number of rows given
  $upcomingEvents = $eventsPage->children()->listed()->filter(function($child) use ($today) {
    return $child->date()->toDate('Y-m-d') >= $today;
  })->sortBy('date', 'asc')->limit($rows);

  // Assuming $upcomingEvents has been filtered and sorted already
  $groupedEvents = $upcomingEvents->groupBy(function ($child) {
    return $child->date()->toDate('Y-m');
  });

  if ($hideFirstEvent) { 
    $upcomingEvents = $upcomingEvents->offset(1);
  }

  if ($groupByMonth) {
    $groupedEvents = $upcomingEvents->groupBy(function ($child) {
      return $child->date()->toDate('Y-m');
    });
  } else {
    $groupedEvents = [$upcomingEvents]; // Wrap in array for consistent foreach structure
  }
?>

<section>
  <h2 class="text-3xl my-10">Upcoming Events</h2>

  <?php foreach ($groupedEvents as $month => $events): ?>
    <?php if ($groupByMonth): ?>
      <h3 class="text-3xl my-10">
        <?= date('F Y', strtotime($month)) ?>
      </h3>
    <?php endif; ?>
    <?php foreach ($events as $event): ?>
      <article class="mb-10 flex gap-5">
        <?php if ($event->files()->valid()): ?>
          <img 
            src="<?= $event->files()->first()->url() ?>" 
            alt="<?= $event->files()->first()->alt() ?>" 
            class="h-32 w-32"
          >
        <?php else: ?>
          <img 
            src="<?= $site->placeholderEventImage()->toFile()->url() ?>" 
            alt="Placeholder" 
            class="h-32 w-32"
          >
        <?php endif; ?>
        <div class="">
          <h2><?= $event->title()->html() ?></h2>
          <p>Date: <?= $event->date()->toDate('F j, Y') ?></p>
        </div>
      </article>
    <?php endforeach; ?>
  <?php endforeach; ?>  
</section>
