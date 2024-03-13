

<?php 
  // $showPastEvents = get('showPastEvents', false);
?>

<?= snippet('header') ?>
<h1 class="text-5xl uppercase my-32"><?= $page->title() ?></h1>
<div class="blocks">
  <?php foreach ($page->blocks()->toBlocks() as $block): ?>
    <div class="block" data-type="<?= $block->type() ?>">
      <?= $block ?>
    </div>
  <?php endforeach; ?>
</div>
<?= snippet('footer') ?>

