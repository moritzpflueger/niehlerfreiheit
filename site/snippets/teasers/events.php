<?php
  $rows = $rows ?? 3;
  $eventsPage = $site->find('events');
  $today = 

  // Filter for future events, sort them by date, and limit to number of rows given
  $events = $eventsPage
    ->children()
    ->listed()
    ->filterBy('date', '>=', date('Y-m-d'))
    ->sortBy('date', 'asc')
    ->limit($rows);
  
  // Move the most upcoming featured event to the beginning of the events array
  $featuredEvent = $events->filter(function($event) {
    return $event->isFeatured()->isTrue();
  })->sortBy('date', 'asc')->first();

  if ($featuredEvent && $featuredEvent->valid()) {
    $events = $events->prepend($featuredEvent);
  };
?>

<section class="my-32">
  <?php foreach ($events as $event): ?>
    <?php if ($event === $events->first()): ?>
      <article class="flex flex-col gap-5 my-16">
        <a href="<?= $event->url()?>" class="relative">
          <div class="px-10">
            <div class="uppercase sm:text-3xl mb-2 bg-white text-black filter inline-flex">
              <?= $event->date()->toDate('EEEE dd MMMM') ?>
            </div>
            <h2 class="text-4xl sm:text-6xl uppercase font-bold italic tracking-tight"><?= $event->title()->html() ?></h2>
          </div>
          <img 
            src="<?= $event->files()->first()->url(); ?>" 
            alt="<?= $event->files()->first()->alt(); ?>" 
            class="mt-10"
          >
          <!-- <p class="px-10"><?= $event->text()->excerpt(200) ?></p> -->
          <a href="<?= $event->url() ?>" class="text-yellow-500 text-xl hover:underline flex items-center gap-3 px-10 ml-auto">
            VIEW DETAILS
            <div class="w-10">
              <?= file_get_contents(kirby()->root('assets') . '/icons/arrowRight.svg'); ?>
            </div>
          </a>
        </a>
      </article>
    <?php else: ?>
      <?php snippet('events/listItem', [
        'event' => $event,
        'highlightFeaturedEvent' => true,
        ]) ?>
    <?php endif; ?>
  <?php endforeach; ?>

  <a href="<?= $site->url() ?>/events" class="text-yellow-500 text-xl uppercase hover:underline flex items-center justify-end gap-3">
    <?= t('events.button.viewUpcoming') ?>
    <div class="w-10">
      <?= file_get_contents(kirby()->root('assets') . '/icons/arrowRight.svg'); ?>
    </div>
  </a>
</section>

<!-- text-[#00538A] -->