<?= snippet('header') ?>

<section class="flex-1">
  <!-- <h1><?= $showPastEvents ? "Archiv" : "Programm" ?></h1> -->

  <?php snippet('events/filter', [
    'dateFilters' => $dateFilters,
    'categoryFiltersNonRecurringEvents' => $categoryFiltersNonRecurringEvents,
    'categoryFiltersRecurringEvents' => $categoryFiltersRecurringEvents,
    'selectedDateFilters' => $selectedDateFilters,
    'selectedCategoryFilters' => $selectedCategoryFilters,
    'showPastEvents' => $showPastEvents,
  ]) ?>

  <?php if ($groupedEvents->isEmpty()): ?>
    <p class="text-xl w-full flex items-center justify-center py-32">No events found</p>
  <?php endif; ?>

  <?php foreach ($groupedEvents as $monthName => $events): ?>


    <?php $index = 0; ?>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 border-t border-neutral-700">
      <h3 class="h-full flex items-center justify-center border-b border-r border-neutral-700 py-16">
        <?= !$showYear ? strtok($monthName, ' ') : $monthName ?>
      </h3>
      <?php foreach ($events as $event): ?>
        <?php snippet('events/listItem', [
          'event' => $event,
          'showYear' => $showYear
        ]) ?>
        <?php $index++; ?>
      <?php endforeach; ?>
    </div>
  <?php endforeach; ?>

  <?php if (!$showPastEvents): ?>
    <a href="<?= $page->url() ?>?showPastEvents=true" class="text-yellow-500 text-xl uppercase py-32 hover:underline flex items-center justify-center border-y border-neutral-700">
      <?= t('events.button.viewPast') ?>
      <div class="w-10">
        <?= file_get_contents(kirby()->root('assets') . '/icons/arrowRight.svg'); ?>
      </div>
    </a>
  <?php else: ?>
    <a href="<?= $page->url() ?>" class="text-yellow-500 text-xl uppercase py-32 hover:underline flex items-center justify-center border-y border-neutral-700">
      Show upcoming Events
      <div class="w-10">
        <?= file_get_contents(kirby()->root('assets') . '/icons/arrowRight.svg'); ?>
      </div>
    </a>
  <?php endif ?>
</section>

<?= snippet('footer') ?>