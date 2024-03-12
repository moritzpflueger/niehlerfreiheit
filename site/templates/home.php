<?php snippet('header') ?>
<section class="">
  <?php snippet('events/hero')?>
  <?php 
    snippet(
      'events/list', [
        'hideFirstEvent' => true, 
        'showEventsLink' => true,
        'rows' => 3,
    ]) 
  ?>
</section>
<?php snippet('teasers/post') ?>
<?php snippet('teasers/newsletter') ?>
<?php snippet('footer') ?>

