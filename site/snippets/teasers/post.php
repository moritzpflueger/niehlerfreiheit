<?php 
$layout = $layout ?? null;
$posts = page('posts')->children()->listed()->limit(1);
$post = $post ?? $posts->first();

$textBlock = $post->blocks()->toBlocks()->filter(function($block) {
      return $block->type() === 'text';
  })->first();

if ($textBlock) {
  $teaserText = $textBlock->excerpt($layout === 'small' ? 250 : 350);  
} else {
  $teaserText = "No text available.";
}
?>

<section class="flex <?= $layout === 'small' ? 'text-left' : 'text-center' ?>">
  <div class="">
    <h2 class="<?= $layout === 'small' ? 'text-2xl' : '' ?>">
      <?= $post->title() ?>
    </h2>
    <p class="text-neutral-500">
      <?= $teaserText ?>
    </p>
    <a href="<?= $post->url() ?>"  class="text-yellow-500 text-xl uppercase hover:underline flex justify-end items-center gap-3">
      Read more
      <div class="w-10">
        <?= file_get_contents(kirby()->root('assets') . '/icons/arrowRight.svg'); ?>
      </div>      
    </a>  
  </div>
</section>