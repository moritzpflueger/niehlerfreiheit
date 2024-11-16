<p class="max-w-2xl pb-16 px-3 pt-2">
  <?= $block->text() ?>
</p>
<img src="<?= $block->image()->toFile()->url() ?>" alt="<?= $block->image()->toFile()->alt() ?>" class="mb-10 w-full">