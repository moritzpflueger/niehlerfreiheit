<?php
  $rows = $rows ?? 3;
  $hideFirstEvent = $hideFirstEvent ?? false;
  if ($hideFirstEvent) $rows++;
  $groupByMonth = $groupByMonth ?? false;
  $showEventsLink = $showEventsLink ?? false;
  $showPastEvents = $showPastEvents ?? false;

  $eventsPage = $site->find('events');
  $today = date('Y-m-d');

  // Filter for future events, sort them by date, and limit to number of rows given
  $events = $eventsPage->children()->listed()->filter(function($child) use ($today, $showPastEvents) {
    if ($showPastEvents) { 
      return true;
    }
    return $child->date()->toDate('YYYY-MM-dd') >= $today;
  })->sortBy('date', 'asc')->limit($rows);

  if ($hideFirstEvent) {
    $events = $events->offset(1);
  }

  if ($groupByMonth) {
    $groupedEvents = $events->groupBy(function ($child) {
      return $child->date()->toDate('MMMM Y');
    });
  } else {
    $groupedEvents = [$events]; // Wrap in array for consistent foreach structure
  }
?>

<section class="my-32">
  <?php foreach ($groupedEvents as $monthName => $events): ?>
    <?php if ($groupByMonth): ?>
      <h3 class="text-5xl font-bold mb-10 mt-20 uppercase">
        <?= strtok($monthName, ' ') ?> <!-- remove the year -->
      </h3>
    <?php endif; ?>
    <?php foreach ($events as $event): ?>
      <?php snippet('components/events/listItem', ['event' => $event]) ?>
    <?php endforeach; ?>
  <?php endforeach; ?>
  <?php if ($showEventsLink): ?>
    <a href="<?= $site->url() ?>/events" class="text-yellow-500">
      <?= t('events.button.viewAll') ?>
    </a>
  <?php endif; ?>
</section>