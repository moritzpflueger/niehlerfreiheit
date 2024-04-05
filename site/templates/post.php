

<?php 
  // $showPastEvents = get('showPastEvents', false);
?>

<?= snippet('header') ?>
<section class="max-w-4xl mx-auto">
  <h1 class="text-5xl sm:text-6xl"><?= $page->title() ?></h1>
  <div class="blocks">
    <?php foreach ($page->blocks()->toBlocks() as $block): ?>
      <div class="block" data-type="<?= $block->type() ?>">
        <?= $block ?>
      </div>
    <?php endforeach; ?>
  </div>
</section>
<div class="my-32 max-w-7xl mx-auto">
  <!-- <h2>Read more</h2> -->
  <ul class="flex flex-col md:flex-row gap-10">
    <?php 
      $posts = $site
        ->find('posts')
        ->children()
        ->filterBy('title', '!=', $page->title())
        ->listed()
        ->limit(3);
      foreach ($posts as $post):
    ?>
    <li class="p-10 flex-1 border-2 border-[#00538A]">
      <?= snippet('teasers/post', ['post' => $post, 'layout' => 'small']) ?>
    </li>
    <?php endforeach; ?>
  </ul>    
</div>
<?= snippet('footer') ?>

