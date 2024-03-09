<div class="flex w-full justify-center">
  <div class="bg-neutral-800 w-full max-w-4xl py-10 px-5">
    <h1 class="text-4xl"><?= $page->title() ?></h1>
    <?= $page->text() ?>
    <p class="py-10">
      <?= $site->infoText()->kirbytext() ?>
    </p>    
  </div>  
</div>