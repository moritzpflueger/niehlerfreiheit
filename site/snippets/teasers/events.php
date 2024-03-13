<?php
  $rows = $rows ?? 3;
  $eventsPage = $site->find('events');
  $today = 

  // Filter for future events, sort them by date, and limit to number of rows given
  $events = $eventsPage
    ->children()
    ->listed()
    ->filterBy('date', '>=', date('Y-m-d'))
    ->sortBy('date', 'asc')
    ->limit($rows);
  
  // Move the most upcoming featured event to the beginning of the events array
  $featuredEvent = $events->filter(function($event) {
    return $event->isFeatured()->isTrue();
  })->sortBy('date', 'asc')->first();

  if ($featuredEvent && $featuredEvent->valid()) {
    $events = $events->prepend($featuredEvent);
  };
?>

<section class="my-32">
  <?php foreach ($events as $event): ?>
    <?php snippet('events/listItem', [
      'event' => $event,
      'showYear' => false,
      'highlightFeaturedEvent' => true,
    ]) ?>
  <?php endforeach; ?>

  <a href="<?= $site->url() ?>/events" class="text-yellow-500 text-xl uppercase hover:underline flex items-center gap-3">
    <?= t('events.button.viewUpcoming') ?>
    <div class="w-10">
      <?= file_get_contents(kirby()->root('assets') . '/icons/arrowRight.svg'); ?>
    </div>
  </a>
</section>
