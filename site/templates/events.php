<?php 
  $showPastEvents = get('showPastEvents', false);
?>

<?= snippet('header') ?>
<?php if ($showPastEvents): ?>
  <h1 class="text-3xl font-bold uppercase my-10">
    Vergangene Veranstaltungen
  </h1>
<?php endif ?>
<?= snippet('events/list', [
  'rows' => 1000, 
  'groupByMonth' => true,
  'showPastEvents' => $showPastEvents ?? false,
  'showPastEventsLink' => !$showPastEvents ?? true,
]) ?>
<?= snippet('footer') ?>

