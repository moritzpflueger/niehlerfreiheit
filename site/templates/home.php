<?php
$homepage = $page;
?>
<?php snippet('header') ?>
<main class="">
  <?php foreach ($homepage->blocks()->toBlocks() as $block): ?>
    <section class="block my-20 first:mt-0" data-type="<?= $block->type() ?>">
      <?= $block ?>
      <!-- This is some kirby magic, 
      that when you have a snippet
      in the snippets/blocks folder 
      named like the block type. -->
    </section>
  <?php endforeach; ?>
</main>
<?php snippet('footer') ?>