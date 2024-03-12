<?php snippet('header') ?>
<section class="">
  <?php 
    snippet(
      'events/list', [
        'hideFirstEvent' => true, 
        'showEventsLink' => true,
        'rows' => 4,
        'highlightFeaturedEvent' => true,
    ]) 
  ?>
</section>
<?php snippet('teasers/post') ?>
<?php snippet('teasers/newsletter') ?>
<?php snippet('footer') ?>

