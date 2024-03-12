<?php 

$posts = page('posts')->children()->listed()->limit(1);
$post = $posts->first();

?>

<section class="flex">
  <div class="w-1/3 ">
    <img src="<?= $post->files()->first()->url() ?>" />    
  </div>
  <div class="pl-10 w-2/3">
    <h1 class="text-4xl"><?= $post->title() ?></h1>
    <p class="my-10">
      <?= $post->text()->excerpt(200) ?>
    </p>
    <a href="<?= $post->url() ?>"  class="text-yellow-500 text-xl hover:underline flex items-center gap-3">
      Read more
      <div class="w-10">
        <?= file_get_contents(kirby()->root('assets') . '/icons/arrowRight.svg'); ?>
      </div>      
    </a>  
  </div>
</section>