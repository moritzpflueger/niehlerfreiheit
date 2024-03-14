<?= snippet('header') ?>

<section class="my-32 max-w-4xl mx-auto">
  <h1><?= $showPastEvents ? "Archiv" : "Programm" ?></h1>

  <?php snippet('events/filter', [
    'filters' => $filters,
    'selectedFilter' => $selectedFilter,
    'showPastEvents' => $showPastEvents,
  ]) ?>

  <?php foreach ($groupedEvents as $monthName => $events): ?>
    <h3 class="text-6xl mb-20 mt-32 first-of-type:mt-0 uppercase">
      <?= !$showYear ? strtok($monthName, ' ') : $monthName ?>
    </h3>

    <?php $index = 0; ?>
    <?php foreach ($events as $event): ?>
      <?php snippet('events/listItem', [
        'event' => $event,
        'showYear' => $showYear
      ]) ?>
      <?php $index++; ?>
    <?php endforeach; ?>
  <?php endforeach; ?>
 
  <?php if(!$showPastEvents): ?>
    <a href="<?= $page->url() ?>?showPastEvents=true" class="text-yellow-500 text-xl uppercase hover:underline flex items-center gap-3">
      <?= t('events.button.viewPast') ?>
      <div class="w-10">
        <?= file_get_contents(kirby()->root('assets') . '/icons/arrowRight.svg'); ?>
      </div>
    </a>
  <?php else: ?>
    <a href="<?= $page->url() ?>" class="text-yellow-500 text-xl uppercase hover:underline flex items-center gap-3">
      Show upcoming Events
      <div class="w-10">
        <?= file_get_contents(kirby()->root('assets') . '/icons/arrowRight.svg'); ?>
      </div>
    </a>    
  <?php endif ?>
</section>

<?= snippet('footer') ?>