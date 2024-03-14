<?php snippet('header') ?>
<main class="">
  <section class="flex justify-center my-32">
    <?php snippet('teasers/heroEvent') ?>
  </section>
  <div class="max-w-4xl mx-auto">
    <section class="my-20">
      <?php snippet('teasers/eventsList', ['rows' => 3]) ?>
    </section>
    <section class="my-48">
      <?php snippet('teasers/post') ?>
    </section>
    <section class="my-20">
      <?php snippet('teasers/newsletter') ?>
    </section>
  </div>
</main>
<?php snippet('footer') ?>

