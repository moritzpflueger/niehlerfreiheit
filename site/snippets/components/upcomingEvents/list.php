<?php
  $rows = $rows ?? 3;
  $hideFirstEvent = $hideFirstEvent ?? false;
  if ($hideFirstEvent) $rows++;
  $groupByMonth = $groupByMonth ?? false;
  $showEventsLink = $showEventsLink ?? false;

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

<section class="my-32">
  <?php foreach ($groupedEvents as $month => $events): ?>
    <?php if ($groupByMonth): ?>
      <h3 class="text-5xl font-bold mb-10 mt-20">
        <?= date('F', strtotime($month)) ?>
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
          <p class="uppercase text-xl"><?= date('D j M', strtotime($event->date())) ?></p>
          <h2 class="text-2xl font-bold"><?= $event->title()->html() ?></h2>
          <p><?= $event->description()->excerpt(100) ?></p>
        </div>
      </article>
    <?php endforeach; ?>
  <?php endforeach; ?>
  <?php if ($showEventsLink): ?>
    <a href="<?= $site->url() ?>/events" class="text-yellow-500">
      View all events
    </a>
  <?php endif; ?>
</section>
