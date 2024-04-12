<?php
  $eventsPage = $site->find('events');
  $excludeHero = $excludeHero ?? true;
  $rows = $block->rows()->toInt();
  $heading = $block->heading();

  $events = $eventsPage
    ->children()
    ->listed()
    ->filterBy('date', '>=', date('Y-m-d'))
    ->sortBy('date', 'asc')
    ->limit($rows);
?>

<h2 class=""><?= $heading ?></h2>

<?php $index = 0; ?>
<?php foreach ($events as $event): ?>
  <?php snippet('events/listItem', [
    'event' => $event,
    'highlightFeaturedEvent' => false,
    'showImage' => true,
    'showDivider' => $index < count($events) - 1
  ]) ?>
  <?php $index++; ?>
<?php endforeach; ?>

<a href="<?= $site->url() ?>/events" class="text-yellow-500 text-xl uppercase hover:underline flex items-center justify-end gap-3">
  <?= t('events.button.viewUpcoming') ?>
  <div class="w-10">
    <?= file_get_contents(kirby()->root('assets') . '/icons/arrowRight.svg'); ?>
  </div>
</a>

<!-- text-[#00538A] -->