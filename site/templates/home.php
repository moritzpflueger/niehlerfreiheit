<?php
  $homepage = $page;
?>
<?php snippet('header') ?>
<main class="max-w-4xl mx-auto">
  <?php foreach ($homepage->blocks()->toBlocks() as $block): ?>
    <section class="block my-20" data-type="<?= $block->type() ?>">
      <?= $block ?>
    </section>
  <?php endforeach; ?>
</main>
<?php snippet('footer') ?>

