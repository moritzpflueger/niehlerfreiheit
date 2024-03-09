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
      <?php snippet('components/upcomingEvents/listItem', ['event' => $event]) ?>
    <?php endforeach; ?>
  <?php endforeach; ?>
  <?php if ($showEventsLink): ?>
    <a href="<?= $site->url() ?>/events" class="text-yellow-500">
      View all events
    </a>
  <?php endif; ?>
</section>
