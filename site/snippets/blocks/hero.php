<div class="grid sm:grid-cols-2 border-b border-neutral-700">
  <div class="col-span-1 flex items-center justify-center px-2 py-2 sm:aspect-square sm:border-r border-neutral-700">
    <p class="px-3 pt-2 w-full">
      <?= $block->text() ?>
    </p>
  </div>
  <div class="col-span-1 order-first sm:order-last border-b sm:border-b-0 border-neutral-700 sm:aspect-square">
    <img
      src="<?= $block->image()->toFile()->url() ?>"
      alt="<?= $block->image()->toFile()->alt() ?>"
      class="w-full h-full object-cover">
  </div>
</div>