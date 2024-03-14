<?php 

$posts = page('posts')->children()->listed()->limit(1);
$post = $posts->first();

$teaserText = $post->blocks()->toBlocks()->filter(function($block) {
      return $block->type() === 'text';
  })->first()->excerpt(500);
  
if (!$teaserText) {
  $teaserText = "No text available.";
}
?>

<section class="flex text-center">
  <div class="">
    <h2><?= $post->title() ?></h2>
    <p class="my-10">
      <?= $teaserText ?>
    </p>
    <a href="<?= $post->url() ?>"  class="text-yellow-500 text-xl uppercase hover:underline flex justify-center items-center gap-3">
      Read more
      <div class="w-10">
        <?= file_get_contents(kirby()->root('assets') . '/icons/arrowRight.svg'); ?>
      </div>      
    </a>  
  </div>
</section>