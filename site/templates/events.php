<?php 
  $showPastEvents = get('showPastEvents', false);
?>

<?= snippet('header') ?>
<!-- <h1 class="text-5xl my-10"><?= $page->title() ?></h1> -->
<?= snippet('components/events/list', [
  'rows' => 1000, 
  'groupByMonth' => true,
  'showPastEvents' => $showPastEvents ?? false,
  'showPastEventsLink' => !$showPastEvents ?? true,
]) ?>
<?= snippet('footer') ?>

