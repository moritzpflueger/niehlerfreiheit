  <nav class="mb-20">
    <a 
      href="<?= $page->url() ?>" 
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
          $formattedFilter = date('F', strtotime($filter));
        ?>
        <a 
          href="<?= $page->url() ?>?filterBy=<?= urlencode($filter) ?>" 
          class="<?= $isActive ? 'bg-yellow-500 text-black' : 'bg-neutral-800 text-neutral-300 ' ?> inline-flex p-2 mb-2 whitespace-nowrap"
        >
          <?= $formattedFilter ?>
        </a>        
      <?php endforeach; ?>        
    <?php endforeach; ?> 
  </nav>