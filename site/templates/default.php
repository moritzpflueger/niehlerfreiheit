
<?php snippet('header') ?>
<div class="">
  <div class="">
    <h1 class="text-4xl"><?= $page->title() ?></h1>
    <?= $page->text() ?>
    <?= $page->description() ?>
    <?php snippet('components/upcomingEvents/hero')?>
    <?php 
      snippet(
        'components/upcomingEvents/list', [
          'hideFirstEvent' => true, 
          'rows' => 3
      ]) 
    ?>    
    <p class="py-10">
      <?= $site->infoText()->kirbytext() ?>
    </p>    
  </div>  
</div>
<?php snippet('footer') ?>

