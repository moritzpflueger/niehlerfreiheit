<?php
$page = $block->page()->toPage();
$url = $page->url();
$imageUrl = $page->image()->url();
$heading = $block->heading();
$text = $block->text();
$layout = $block->layout();
?>

<h2><?= $heading ?></h2>
<div class="flex flex-col sm:flex-row gap-10">
  <div class="flex-1 <?= $layout == 'right' ? 'sm:order-1' : '' ?>">
    <a href="<?= $url ?>" class="text-primary text-xl uppercase hover:underline flex justify-start items-center gap-3">
      <img class="w-full" src="<?= $imageUrl ?>" />
    </a>
  </div>
  <div class="flex-1">
    <p class="text-neutral-500">
      <?= $text ?>
    </p>
    <a href="<?= $url ?>" class="<?= $layout == 'right' ? 'justify-end sm:justify-start' : 'justify-end' ?> text-primary text-xl uppercase hover:underline flex items-center gap-3 mt-3">
      Read more
      <div class="w-10">
        <?= file_get_contents(kirby()->root('assets') . '/icons/arrowRight.svg'); ?>
      </div>
    </a>
  </div>
</div>