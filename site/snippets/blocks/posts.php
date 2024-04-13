<?php 
$posts = page('posts')->children()->listed()->limit(3);

?>

<h2 class="text-center"><?= $block->heading() ?></h2>
<p class="text-center pb-10 text-neutral-500"><?= $block->text() ?></p>

<div class="flex flex-col sm:flex-row gap-5">
  <?php foreach ($posts as $post): 
    $textBlock = $post->blocks()->toBlocks()->filter(function($block) {
          return $block->type() === 'text';
      })->first();
    
    if ($textBlock) {
      $teaserText = $textBlock->excerpt(250);  
    } else {
      $teaserText = "No text available.";
    }?>
    <li class="p-10 list-none flex-1 border-2 border-[#00538A]">
      <?= snippet('teasers/post', ['post' => $post, 'layout' => 'small']) ?>
    </li>
  <?php endforeach; ?>  
</div>