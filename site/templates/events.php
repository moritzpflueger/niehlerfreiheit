<?php 
  $rows = 1000; // TODO: implement pagination
  $groupByMonth = $groupByMonth ?? false;
  $showPastEvents = get('showPastEvents', false);
  $showPastEventsLink = $showPastEventsLink ?? false;
  $showYear = $showPastEvents;

  $eventsPage = $site->find('events');
  $today = date('Y-m-d');

  // Filter for future events, sort them by date, and limit to number of rows given
  $events = $eventsPage
    ->children()
    ->listed()
    ->filter(function($child) use ($today, $showPastEvents) {
      if ($showPastEvents) { 
        return $child->date()->toDate('YYYY-MM-dd') < $today;
      }
      return $child->date()->toDate('YYYY-MM-dd') >= $today;
    })
    ->sortBy('date', $showPastEvents ? 'desc' : 'asc')
    ->limit($rows);

  $dateStrings = [];
  foreach ($events as $event) {
    $dateString = $event->date()->toDate('Y-MM');
    if (!in_array($dateString, $dateStrings)) {
      $dateStrings[] = $dateString;
    }
  }

  $selectedFilter = get('filterBy', null);
  
  $filteredEvents = $events->filter(function($child) use ($selectedFilter) {
    return $child->date()->toDate('Y-MM') === $selectedFilter;
  });  

  if ($filteredEvents->count() > 0) {
    $groupedEvents = $filteredEvents->groupBy(function ($child) {
      return $child->date()->toDate('MMMM Y');
    });
  } else {
    $groupedEvents = $events->groupBy(function ($child) {
      return $child->date()->toDate('MMMM Y');
    });
  }
?>

<?= snippet('header') ?>

<?php if ($showPastEvents): ?>
  <h1 class="text-3xl font-bold uppercase my-10">
    Vergangene Veranstaltungen
  </h1>
<?php endif ?>

<section class="my-32">
  <?php snippet('events/filter', [
    'dateStrings' => $dateStrings,
    'selectedFilter' => $selectedFilter,
    'showPastEvents' => $showPastEvents,
  ]) ?>

  <?php foreach ($groupedEvents as $monthName => $events): ?>
    <h3 class="text-6xl mb-20 mt-32 first-of-type:mt-0 uppercase">
      <?= !$showYear ? strtok($monthName, ' ') : $monthName ?>
    </h3>

    <?php $index = 0; ?>
    <?php foreach ($events as $event): ?>
      <?php snippet('events/listItem', [
        'event' => $event,
        'showYear' => $showYear
      ]) ?>
      <?php $index++; ?>
    <?php endforeach; ?>
  <?php endforeach; ?>
 
  <a href="<?= $page->url() ?>?showPastEvents=true" class="text-yellow-500 text-xl hover:underline flex items-center gap-3">
    <?= t('events.button.viewPast') ?>
    <div class="w-10">
      <?= file_get_contents(kirby()->root('assets') . '/icons/arrowRight.svg'); ?>
    </div>
  </a>
</section>

<?= snippet('footer') ?>



