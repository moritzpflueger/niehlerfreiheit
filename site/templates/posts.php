<?php
  $rows = $rows ?? 3;
  $postsPage = $site->find('posts');

  $posts = $postsPage->children()->listed()->limit($rows);

  $teaserText = function($post) {
    $textBlock = $post->blocks()->toBlocks()->filter(function($block) {
        return $block->type() === 'text';
    })->first();
    
    if ($textBlock) {
      return $textBlock->excerpt(500);
    } else {
      return "No text available.";
    }
  };
?>

<?= snippet('header') ?>

<section class="my-32">
    <?php foreach ($posts as $post): ?>
      <article class="mb-20">
        <a href="<?= $post->url() ?>" class="flex flex-col sm:flex-row gap-10">
          <div class="flex-1">
            <p class="uppercase text-xl"><?= $post->date()->toDate('EEE dd MMMM') ?></p>
            <h2 class="text-2xl  font-bold"><?= $post->title()->html() ?></h2>
            <p><?= $teaserText($post) ?></p>
          </div>    
        </a>
      </article>      
    <?php endforeach; ?>
</section>

<?= snippet('footer') ?>

