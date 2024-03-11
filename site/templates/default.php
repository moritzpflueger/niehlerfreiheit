<?php snippet('header') ?>
<main class="flex-grow">
  <div class="">
    <h1 class="text-4xl my-10"><?= $page->title() ?></h1>
    <?= $page->text()->kirbyText() ?>      
  </div>
</main>
<?php snippet('footer') ?>