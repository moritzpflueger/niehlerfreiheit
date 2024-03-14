<?php snippet('header') ?>
  <main class="max-w-4xl mx-auto">
    <h1 class="text-5xl sm:text-6xl"><?= $page->title() ?></h1>
    <div class="blocks">
      <?php foreach ($page->blocks()->toBlocks() as $block): ?>
        <div class="block" data-type="<?= $block->type() ?>">
          <?= $block ?>
        </div>
      <?php endforeach; ?>
    </div>
  </main>
<?php snippet('footer') ?>