<?php
  $showPastEvents = $showPastEvents ?? false;

  $filterUrl = function($filter = null) use ($page, $showPastEvents) {
    if ($filter === 'all') {
      return $page->url() . ($showPastEvents ? '?showPastEvents=true' : '');
    }
    $queryParams = '?filterBy=' . urlencode($filter) . ($showPastEvents ? '&showPastEvents=true' : '');
    return $page->url() . $queryParams;
  };
  
  // Set the locale based on the site's current language
  setlocale(LC_TIME, kirby()->language()->locale(LC_TIME));
?>
  
<nav class="mb-20">
  <a 
    href="<?= $filterUrl('all') ?>" 
    class="<?= $selectedFilter ? 'bg-neutral-800 text-neutral-300' : 'bg-yellow-500 text-black' ?> inline-block p-2 mb-2 whitespace-nowrap"
  >
    Alle Events
  </a>
  <?php foreach ($filters as $yearName => $filters2): ?>
    <?php if(count($filters) > 1):?>
      <div class="py-5">
        <?= $yearName ?>
      </div>        
    <?php endif; ?>
    <?php foreach($filters2 as $filter): ?>
      <?php
        $isActive = $filter === $selectedFilter;
        // Using IntlDateFormatter for locale-aware formatting
        $locale = kirby()->language();
        $formatter = new IntlDateFormatter($locale, IntlDateFormatter::LONG, IntlDateFormatter::NONE, null, IntlDateFormatter::GREGORIAN, 'MMMM');
        $timestamp = strtotime($filter);
        $formattedFilter = $formatter->format($timestamp);
      ?>
      <a 
        href="<?= $filterUrl($filter) ?>" 
        class="<?= $isActive ? 'bg-yellow-500 text-black' : 'bg-neutral-800 text-neutral-300 ' ?> inline-flex p-2 mb-2 whitespace-nowrap"
      >
        <?= $formattedFilter ?>
      </a>        
    <?php endforeach; ?>        
  <?php endforeach; ?> 
</nav>