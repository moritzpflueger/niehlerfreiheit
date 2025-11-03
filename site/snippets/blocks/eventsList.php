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

$gridClass = '';
switch (count($events)) {
  case 3:
    $gridClass = 'sm:grid-cols-4';
    break;
  case 2:
    $gridClass = 'sm:grid-cols-3';
    break;
  case 1:
    $gridClass = 'sm:grid-cols-2';
    break;
  default:
    $gridClass = 'sm:grid-cols-1';
    break;
}
?>

<!-- <h2 class="text-xl mb-0 uppercase py-32 flex items-center text-center justify-center border-b border-neutral-700"><?= $heading ?></h2> -->

<div class="grid <?= $gridClass ?>">
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
  <a href="<?= $site->url() ?>/events" class="text-primary text-xl uppercase py-10 hover:underline flex items-center justify-center border-b border-neutral-700">
    <?= t('events.button.viewUpcoming') ?>
    <div class="w-10">
      <?= file_get_contents(kirby()->root('assets') . '/icons/arrowRight.svg'); ?>
    </div>
  </a>
</div>



<!-- text-[#00538A] -->