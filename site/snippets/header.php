<header class="py-10">
  <nav class="flex items-center justify-between">
    <a href="<?= $site->url() ?>">
      <img 
        src="<?= $site->logo()->toFile()->url() ?>" alt="<?= $site->title() ?>" 
        class="invert h-16"
      >
    </a>
    <ul class="flex gap-10">
      <li><a href="<?= $site->url() ?>">Home</a></li>
      <li><a href="<?= $site->url() ?>/test">Test</a></li>
      <li><a href="<?= $site->url() ?>/events">Events</a></li>
    </ul>
  </nav>
</header>