<?php snippet('header') ?>
    <h1><?= $page->title() ?></h1>
    <div class="kirbytext">
      <?= $page->text()->kirbyText() ?>
    </div>     
  </div>
</main>
<?php snippet('footer') ?>