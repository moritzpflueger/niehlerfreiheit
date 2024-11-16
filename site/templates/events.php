<?= snippet('header') ?>

<section class="">
  <!-- <h1><?= $showPastEvents ? "Archiv" : "Programm" ?></h1> -->
  
  <?php snippet('events/filter', [
    'dateFilters' => $dateFilters,
    'categoryFiltersNonRecurringEvents' => $categoryFiltersNonRecurringEvents,
    'categoryFiltersRecurringEvents' => $categoryFiltersRecurringEvents,
    'selectedDateFilters' => $selectedDateFilters,
    'selectedCategoryFilters' => $selectedCategoryFilters,
    'showPastEvents' => $showPastEvents,
    ]) ?>

  <?php if($groupedEvents->isEmpty()): ?>
    <p class="text-xl my-32">No events found</p>
  <?php endif; ?>

  <?php foreach ($groupedEvents as $monthName => $events): ?>
    <!-- <h3 class="text-2xl mb-5 sm:mb-10 mt-16 first-of-type:mt-0 uppercase">
      <?= !$showYear ? strtok($monthName, ' ') : $monthName ?>
      <hr class="border-[#00538A] mt-5" />
    </h3> -->

    <?php $index = 0; ?>
    <div class="flex flex-wrap">
      <?php foreach ($events as $event): ?>
        <?php snippet('events/listItem', [
          'event' => $event,
          'showYear' => $showYear
        ]) ?>
        <?php $index++; ?>
      <?php endforeach; ?>
    </div>
  <?php endforeach; ?>
 
  <?php if(!$showPastEvents): ?>
    <a href="<?= $page->url() ?>?showPastEvents=true" class="text-yellow-500 text-xl uppercase hover:underline flex items-center gap-3 mt-16">
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