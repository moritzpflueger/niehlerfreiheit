<?php snippet('header') ?>
<section class="my-10">
  <?php snippet('components/upcomingEvents/hero')?>
  <?php 
    snippet(
      'components/upcomingEvents/list', [
        'hideFirstEvent' => true, 
        'showEventsLink' => true,
        'rows' => 3,
    ]) 
  ?>
</section>
<?php snippet('newsletter') ?>
<?php snippet('footer') ?>

