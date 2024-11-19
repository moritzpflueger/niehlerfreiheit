<div class="grid sm:grid-cols-2 border-b border-neutral-700">
  <div class="col-span-1 flex items-center justify-center px-2 py-2 aspect-square sm:border-r border-neutral-700">
    <p class="px-3 pt-2 max-w-xl">
      <?= $block->text() ?>
    </p>
  </div>
  <div class="col-span-1 border-t sm:border-t-0 border-neutral-700 aspect-square">
    <img
      src="<?= $block->image()->toFile()->url() ?>"
      alt="<?= $block->image()->toFile()->alt() ?>"
      class="w-full h-full object-cover">
  </div>
</div>