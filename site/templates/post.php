

<?php 
  // $showPastEvents = get('showPastEvents', false);
?>

<?= snippet('header') ?>
<h1 class="text-4xl sm:text-6xl uppercase font-bold sm:px-10 tracking-tight my-32"><?= $page->title() ?></h1>
<div class="blocks">
  <?php foreach ($page->blocks()->toBlocks() as $block): ?>
    <div class="block" data-type="<?= $block->type() ?>">
      <?= $block ?>
    </div>
  <?php endforeach; ?>
</div>
<?= snippet('footer') ?>

