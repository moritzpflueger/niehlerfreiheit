<?php snippet('header') ?>
<main class="max-w-4xl flex-1 px-3 py-2">
  <h1><?= $page->title() ?></h1>
  <div class="blocks">
    <?php foreach ($page->blocks()->toBlocks() as $block): ?>
      <div class="block" data-type="<?= $block->type() ?>">
        <?= $block ?>
      </div>
    <?php endforeach; ?>
  </div>
</main>
<?php snippet('footer') ?>