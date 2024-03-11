<?php
  $rows = $rows ?? 3;
  $postsPage = $site->find('posts');

  // Filter for future events, sort them by date, and limit to number of rows given
  $posts = $postsPage->children()->listed()->sortBy('date', 'desc')->limit($rows);
?>

<?= snippet('header') ?>

<section class="my-32">
    <?php foreach ($posts as $post): ?>
      <!-- <?php snippet('events/listItem', ['event' => $post]) ?> -->
      <article class="mb-20">
        <a href="<?= $post->url() ?>" class="flex flex-col sm:flex-row gap-10">
          <div class="flex-1">
            <p class="uppercase text-xl"><?= $post->date()->toDate('EEE dd MMMM') ?></p>
            <h2 class="text-2xl font-bold"><?= $post->title()->html() ?></h2>
            <p><?= $post->text()->excerpt(500) ?></p>
          </div>    
        </a>
      </article>      
    <?php endforeach; ?>
</section>

<?= snippet('footer') ?>

