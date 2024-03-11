

<?php 
  // $showPastEvents = get('showPastEvents', false);
?>

<?= snippet('header') ?>
<h1 class="text-2xl my-10"><?= $page->title() ?></h1>
<p><?= $page->text()->toHtml() ?></p>
<?= snippet('footer') ?>

