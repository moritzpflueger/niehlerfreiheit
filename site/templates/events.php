<?php 
  $showPastEvents = get('showPastEvents', false);
?>

<?= snippet('header') ?>
<h1 class="text-3xl font-bold uppercase my-10"><?= $showPastEvents ? "Vergangene Veranstaltungen" : "" ?></h1>
<?= snippet('events/list', [
  'rows' => 1000, 
  'groupByMonth' => true,
  'showPastEvents' => $showPastEvents ?? false,
  'showPastEventsLink' => !$showPastEvents ?? true,
]) ?>
<?= snippet('footer') ?>

