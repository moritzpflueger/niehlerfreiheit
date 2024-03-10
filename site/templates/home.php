<?php snippet('header') ?>
<section class="my-10">
  <?php snippet('components/events/hero')?>
  <?php 
    snippet(
      'components/events/list', [
        'hideFirstEvent' => true, 
        'showEventsLink' => true,
        'rows' => 3,
    ]) 
  ?>
</section>
<?php snippet('teasers/newsletter') ?>
<?php snippet('footer') ?>

