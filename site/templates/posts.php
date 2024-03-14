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

<section class="my-32 max-w-4xl mx-auto">
    <h1 class="hidden"><?= $page->title() ?></h1>
    <?php foreach ($posts as $post): ?>
      <article class="mb-20">
        <a href="<?= $post->url() ?>">
          <h2><?= $post->title()->html() ?></h2>
          <p><?= $teaserText($post) . " <span class='text-yellow-500'>Read More</span>" ?></p>
        </a>
      </article>      
    <?php endforeach; ?>
</section>

<?= snippet('footer') ?>

