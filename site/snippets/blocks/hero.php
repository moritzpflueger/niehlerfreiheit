<p class="p-12 sm:p-32 sm:pb-12 text-center uppercase text-xl">
  <?= $block->text() ?>
</p>
<img src="<?= $block->image()->toFile()->url() ?>" alt="<?= $block->image()->toFile()->alt() ?>" class="mb-10 w-full">