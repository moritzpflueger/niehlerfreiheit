<?php
  $eventsPage = $site->find('events');
  $today = date('Y-m-d');
  // Filter for future events, sort them by date, and retrieve the first event
  $event = $eventsPage
    ->children()
    ->listed()
    ->filter(function($child) use ($today) {
      return $child->date()->toDate('YYYY-MM-dd') >= $today;
    })
    ->sortBy('date', 'asc')
    ->first();

  if (!$event) return;

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
?>

<section class="my-16">
  <article class="flex flex-col gap-5">
    <a href="<?= $eventUrl?>">
      <div class="">
        <div class="uppercase text-2xl mb-5  inline-flex px-10">
          <?= $event->date()->toDate('E dd MMMM') ?>
        </div>
        <h2 class="text-6xl uppercase font-bold px-10 tracking-tight"><?= $event->title()->html() ?></h2>
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
