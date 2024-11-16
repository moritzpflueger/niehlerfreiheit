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
  <?php if ($page->uri() == "impressum" || $page->uri() == "imprint"): ?>
    <div class="py-10">Website made with ❤️ by <a class="underline" href="https://www.moritzpflueger.com/en/">Moritz Pflüger</a></div>
  <?php endif; ?>
</main>
<?php snippet('footer') ?>