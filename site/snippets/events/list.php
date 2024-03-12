<?php
  $rows = $rows ?? 3;
  $hideFirstEvent = $hideFirstEvent ?? false;
  if ($hideFirstEvent) $rows++;
  $groupByMonth = $groupByMonth ?? false;
  $showEventsLink = $showEventsLink ?? false;
  $showPastEvents = $showPastEvents ?? false;
  $showPastEventsLink = $showPastEventsLink ?? false;
  $showYear = $showPastEvents;

  $eventsPage = $site->find('events');
  $today = date('Y-m-d');

  // Filter for future events, sort them by date, and limit to number of rows given
  $events = $eventsPage->children()->listed()->filter(function($child) use ($today, $showPastEvents) {
    if ($showPastEvents) { 
      return $child->date()->toDate('YYYY-MM-dd') < $today;
    }
    return $child->date()->toDate('YYYY-MM-dd') >= $today;
  })->sortBy('date', $showPastEvents ? 'desc' : 'asc')->limit($rows);

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
      <h3 class="text-6xl mb-20 mt-32 first:mt-0 uppercase">
        <?= !$showYear ? strtok($monthName, ' ') : $monthName ?>
      </h3>
    <?php endif; ?>

    <?php foreach ($events as $event): ?>
      <?php snippet('events/listItem', [
        'event' => $event,
        'showYear' => $showYear,
      ]) ?>
    <?php endforeach; ?>

  <?php endforeach; ?>

  <?php if ($showEventsLink): ?>
    <a href="<?= $site->url() ?>/events" class="text-yellow-500 text-xl uppercase hover:underline flex items-center gap-3">
      <?= t('events.button.viewUpcoming') ?>
      <div class="w-10">
        <?= file_get_contents(kirby()->root('assets') . '/icons/arrowRight.svg'); ?>
      </div>
    </a>
  <?php endif; ?>
 
  <?php if ($showPastEventsLink): ?>
    <a href="<?= $site->url() ?>/events?showPastEvents=true" class="text-yellow-500 text-xl hover:underline flex items-center gap-3">
      <?= t('events.button.viewPast') ?>
      <div class="w-10">
        <?= file_get_contents(kirby()->root('assets') . '/icons/arrowRight.svg'); ?>
      </div>
    </a>
  <?php endif; ?>
</section>
