<?php
  $eventUrl = $event->url();
  $isValid = $event->files()->valid();
  $placeholderUrl = $site->placeholderImage()->toFile()->url();
  if ($isValid) {
    $imageUrl = $event->files()->first()->url();
    $imageAlt = $event->files()->first()->alt();
  } else {
    $imageUrl = $placeholderUrl;
    $imageAlt = 'Placeholder Image';
  };
  $hasSpotlightEvent = $hasSpotlightEvent ?? false;
  $showYear = $showYear ?? false;
?>

<?php if ($hasSpotlightEvent): ?>
  <section class="my-16">
    <article class="flex flex-col gap-5">
      <a href="<?= $eventUrl?>">
        <div class="">
          <div class="uppercase sm:text-2xl mb-5  inline-flex sm:px-10">
            <?= $event->date()->toDate('E dd MMMM') ?>
          </div>
          <h2 class="text-4xl sm:text-6xl uppercase font-bold sm:px-10 tracking-tight"><?= $event->title()->html() ?></h2>
        </div>
        <img 
          src="<?= $imageUrl ?>" 
          alt="<?= $imageAlt ?>" 
          class="mt-10 w-full"
        >
        <!-- <p class="px-10"><?= $event->text()->excerpt(200) ?></p> -->
        <a href="<?= $eventUrl ?>" class="text-yellow-500 text-xl hover:underline flex items-center gap-3 px-10 ml-auto">
          VIEW DETAILS
          <div class="w-10">
            <?= file_get_contents(kirby()->root('assets') . '/icons/arrowRight.svg'); ?>
          </div>
        </a>
      </a>
    </article>
  </section>
<?php else: ?>
  <article class="mb-20">
    <a href="<?= $eventUrl ?>" class="flex flex-col sm:flex-row gap-10">
      <div class="sm:w-1/4">
        <img src="<?= $imageUrl ?>" alt="<?= $imageAlt ?>" />
      </div>
      <div class="flex-1">
        <p class="sm:text-xl uppercase mb-3"><?= $event->date()->toDate($showYear ? 'EEE dd MMMM Y' : 'EEE dd MMMM') ?></p>
        <h2 class="text-3xl sm:text-5xl uppercase font-bold mb-3"><?= $event->title()->html() ?></h2>
        <p>Einlass: 19:00 Uhr</p>
        <p>Abendkasse: 15 €</p>
        <!-- <p><?= $event->text()->excerpt(100) ?></p> -->
      </div>    
    </a>
  </article>
<?php endif; ?>





