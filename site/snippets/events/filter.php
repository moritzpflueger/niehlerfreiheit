  <nav class="mb-20">
    <a 
      href="<?= $page->url() ?>" 
      class="<?= $selectedFilter ? 'bg-neutral-800' : 'bg-yellow-500 text-black' ?> inline-flex p-2 mb-2 whitespace-nowrap"
    >
      Alle Events
    </a>
    <?php foreach ($dateStrings as $filter): ?>
      <?php
        $isActive = $filter === $selectedFilter;
        $formattedFilter = date('F', strtotime($filter));
      ?>
      <a 
        href="<?= $page->url() ?>?filterBy=<?= urlencode($filter) ?>" 
        class="<?= $isActive ? 'bg-yellow-500 text-black' : 'bg-neutral-800' ?> inline-flex p-2 mb-2 whitespace-nowrap"
      >
        <?= $formattedFilter ?>
      </a>
    <?php endforeach; ?> 
  </nav>