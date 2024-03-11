<?php 

$posts = page('posts')->children()->listed()->limit(1);
$post = $posts->first();

?>

<section class="my-32 p-20 bg-neutral-900">
  <img src="<?= $post->files()->first()->url() ?>" />
  <h1 class="text-4xl mt-10"><?= $post->title() ?></h1>
  <p class="my-10">
    <?= $post->text()->excerpt(200) ?>
  </p>
  <a href="<?= $post->url() ?>" class="bg-[#00538A] text-white font-bold py-3 px-5">
    Open post
  </a>
</section>