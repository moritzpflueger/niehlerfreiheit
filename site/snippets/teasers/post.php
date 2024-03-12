<?php 

$posts = page('posts')->children()->listed()->limit(1);
$post = $posts->first();

?>

<section class="flex text-center">
  <!-- <div class="w-1/3 ">
    <img src="<?= $post->files()->first()->url() ?>" />    
  </div> -->
  <div class="">
    <h1 class="text-2xl uppercase font-bold"><?= $post->title() ?></h1>
    <p class="my-10">
      <?= $post->text()->excerpt(600) ?>
    </p>
    <a href="<?= $post->url() ?>"  class="text-yellow-500 text-xl uppercase hover:underline flex justify-center items-center gap-3">
      Read more
      <div class="w-10">
        <?= file_get_contents(kirby()->root('assets') . '/icons/arrowRight.svg'); ?>
      </div>      
    </a>  
  </div>
</section>