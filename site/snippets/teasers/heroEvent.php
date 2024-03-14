<?php
  $eventsPage = $site->find('events');

  $event = $eventsPage
    ->children()
    ->listed()
    ->filterBy('date', '>=', date('Y-m-d'))
    ->filterBy('isFeatured', '==', 'true')
    ->first()
?>

<article class="flex flex-col gap-5">
  <a href="<?= $event->url()?>" class="relative">
    <div class="">
      <!-- <div class="uppercase sm:text-3xl mb-2 bg-white text-black filter inline-flex">
        <?= $event->date()->toDate('EEEE dd MMMM') ?>
      </div> -->
      <div class="text-5xl sm:text-6xl uppercase tracking-tight">
        <?= $event->date()->toDate('EEEE dd MMMM') ?>
      </div>
      
      <h2><?= $event->title() ?></h2>
    </div>
    <img 
      src="<?= $event->files()->first()->url(); ?>" 
      alt="<?= $event->files()->first()->alt(); ?>" 
      class="mt-10"
    >
    <!-- <p class="px-10"><?= $event->text()->excerpt(200) ?></p> -->
    <!-- <a href="<?= $event->url() ?>" class="text-yellow-500 text-xl hover:underline flex items-center gap-3 px-10 ml-auto">
      VIEW DETAILS
      <div class="w-10">
        <?= file_get_contents(kirby()->root('assets') . '/icons/arrowRight.svg'); ?>
      </div>
    </a> -->
  </a>
</article>

<!-- text-[#00538A] -->