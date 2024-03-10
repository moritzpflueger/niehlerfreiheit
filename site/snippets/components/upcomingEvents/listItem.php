<article class="mb-10">
  <a href="<?= $event->url() ?>" class="flex gap-5">
    <?php if ($event->files()->valid()): ?>
      <img 
        src="<?= $event->files()->first()->url() ?>" 
        alt="<?= $event->files()->first()->alt() ?>" 
        class="h-32 w-32"
      >
    <?php else: ?>
      <img 
        src="<?= $site->placeholderEventImage()->toFile()->url() ?>" 
        alt="Placeholder" 
        class="h-32 w-32"
      >
    <?php endif; ?>
    <div class="">
      <p class="uppercase text-xl"><?= $event->date()->toDate('EEE dd MMMM') ?></p>
      <h2 class="text-2xl font-bold"><?= $event->title()->html() ?></h2>
      <p><?= $event->description()->excerpt(100) ?></p>
    </div>    
  </a>
</article>