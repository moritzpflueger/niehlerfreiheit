<?php snippet('header') ?>
<main class="flex-grow">
  <div class="">
    <h1 class="text-4xl uppercase my-10"><?= $page->title() ?></h1>
    <div class="kirbytext">
      <?= $page->text()->kirbyText() ?>
    </div>     
  </div>
</main>
<?php snippet('footer') ?>