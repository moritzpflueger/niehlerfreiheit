<?php
$showPastEvents = $showPastEvents ?? false;
$selectedDateFilters = array_filter(explode(',', get('filterBy', '')), function ($value) {
  return $value !== '';
});
$selectedCategoryFilters = array_filter(explode(',', get('category', '')), function ($value) {
  return $value !== '';
});

$filterUrl = function ($filter, $filterType) use ($page, $showPastEvents, $selectedDateFilters, $selectedCategoryFilters) {
  if ($filterType === 'date') {
    if (in_array($filter, $selectedDateFilters)) {
      // Entferne den Filter, wenn er bereits ausgewählt ist
      $updatedDateFilters = array_diff($selectedDateFilters, [$filter]);
    } else {
      // Füge den Filter hinzu, wenn er noch nicht ausgewählt ist
      $updatedDateFilters = array_merge($selectedDateFilters, [$filter]);
    }
    $updatedCategoryFilters = $selectedCategoryFilters;
  } elseif ($filterType === 'category') {
    if (in_array($filter, $selectedCategoryFilters)) {
      $updatedCategoryFilters = array_diff($selectedCategoryFilters, [$filter]);
    } else {
      $updatedCategoryFilters = array_merge($selectedCategoryFilters, [$filter]);
    }
    $updatedDateFilters = $selectedDateFilters;
  }

  // Erstelle die URL mit den aktualisierten Filtern
  $queryParams = http_build_query([
    'filterBy' => implode(',', $updatedDateFilters),
    'category' => implode(',', $updatedCategoryFilters),
    'showPastEvents' => $showPastEvents ? 'true' : null,
  ]);

  return rtrim($page->url() . '?' . $queryParams, '?');
};
?>

<nav class="border-b border-neutral-700 py-8 px-6">
  <div class="flex items-center justify-between px-2">
    <button
      id="toggleFilters"
      class="text-neutral-200 uppercase flex items-center">
      <span class="w-6 mr-3"><?= file_get_contents(kirby()->root('assets') . '/icons/filter.svg'); ?></span>
      <span id="buttonText"><?= t('events.button.showFilters') ?> ‣</span>
    </button>
    <button
      id="clearFilters"
      class="text-neutral-200 uppercase <?= ((count($selectedCategoryFilters) + count($selectedDateFilters)) === 0 ? 'hidden' : '') ?>">
      <?= t('events.button.clearAll') ?>
      <span class=" <?= ((count($selectedCategoryFilters) + count($selectedDateFilters)) > 0 ? 'font-bold text-yellow-500' : 'text-neutral-500') ?>">
        (<?= count($selectedCategoryFilters) + count($selectedDateFilters) ?>)
      </span>
    </button>
  </div>
  <div id="filters" class="hidden text-base px-3 pt-2 pb-6">
    <div class="py-2">
      <?= t('events.categories') ?>
    </div>
    <?php
    foreach ($categoryFiltersNonRecurringEvents as $filter):
      $isActive = in_array($filter, $selectedCategoryFilters);
    ?>
      <a
        href="<?= $filterUrl($filter, 'category') ?>"
        class="<?= $isActive ? 'bg-lime-600 border-lime-600 text-black' : 'border-lime-600 text-lime-600 ' ?> border inline-flex mb-2 px-1 whitespace-nowrap uppercase items-center">
        <?= $filter ?>
      </a>
    <?php endforeach; ?>

    <!-- <div class="py-5">
      Regelmäßige Termine
    </div>     -->
    <?php
    foreach ($categoryFiltersRecurringEvents as $filter):
      $isActive = in_array($filter, $selectedCategoryFilters);
    ?>
      <a
        href="<?= $filterUrl($filter, 'category') ?>"
        class="<?= $isActive ? 'bg-cyan-500 border-cyan-500 text-black' : 'border-cyan-500 text-cyan-500 ' ?> border inline-flex mb-2 px-1 whitespace-nowrap uppercase">
        <?= $filter ?>
      </a>
    <?php endforeach; ?>


    <?php foreach ($dateFilters as $yearName => $filters2): ?>
      <div class="py-2">
        <?= $yearName ?>
      </div>
      <?php foreach ($filters2 as $filter): ?>
        <?php
        $isActive = in_array($filter, $selectedDateFilters);
        // Using IntlDateFormatter for locale-aware formatting
        $locale = kirby()->language();
        $formatter = new IntlDateFormatter($locale, IntlDateFormatter::LONG, IntlDateFormatter::NONE, null, IntlDateFormatter::GREGORIAN, 'MMMM');
        $timestamp = strtotime($filter);
        $formattedFilter = $formatter->format($timestamp);
        ?>
        <a
          href="<?= $filterUrl($filter, 'date') ?>"
          class="<?= $isActive ? 'bg-neutral-200 text-black' : 'border-neutral-200 text-neutral-200 ' ?> border inline-flex px-1 mb-2 whitespace-nowrap">
          <?= $formattedFilter ?>
        </a>
      <?php endforeach; ?>
    <?php endforeach; ?>
  </div>
</nav>

<script>
  document.getElementById('clearFilters').addEventListener('click', function() {
    window.location.href = '<?= $page->url() ?>';
  });

  document.getElementById('toggleFilters').addEventListener('click', function() {
    document.getElementById('filters').classList.toggle('hidden');
    const buttonText = document.getElementById('buttonText');
    const isHidden = document.getElementById('filters').classList.contains('hidden');

    localStorage.setItem('filtersVisible', !isHidden ? 'true' : 'false');

    updateButtonText();
  });

  // Call this function on page load to set the correct initial state and button text
  document.addEventListener('DOMContentLoaded', function() {
    const isFiltersVisible = localStorage.getItem('filtersVisible') === 'true';
    if (isFiltersVisible) {
      document.getElementById('filters').classList.remove('hidden');
    } else {
      document.getElementById('filters').classList.add('hidden');
    }
    updateButtonText();
  });

  // Function to update the button text based on the filters' visibility
  function updateButtonText() {
    const isFiltersVisible = localStorage.getItem('filtersVisible') === 'true';
    const buttonText = document.getElementById('buttonText');
    buttonText.textContent = isFiltersVisible ? '<?= t('events.button.hideFilters') ?> ▾' : '<?= t('events.button.showFilters') ?> ‣';
  }
</script>