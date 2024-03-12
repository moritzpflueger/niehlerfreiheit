

<?php 
  // $showPastEvents = get('showPastEvents', false);
?>

<?= snippet('header') ?>
<h1 class="text-5xl uppercase my-32"><?= $page->title() ?></h1>
<div class="kirbytext">
  <?= $page->text()->kirbyText() ?>
</div>
<?= snippet('footer') ?>

