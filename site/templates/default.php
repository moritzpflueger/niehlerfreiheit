<?php snippet('header') ?>
  <main class="max-w-4xl mx-auto">
    <h1><?= $page->title() ?></h1>
    <div class="kirbytext">
      <?= $page->text()->kirbyText() ?>
    </div>     
  </main>
<?php snippet('footer') ?>