<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="assets/safari-pinned-tab.svg" color="#000000">
    <meta name="msapplication-TileColor" content="#000000">
    <meta name="theme-color" content="#000000">  
    <title><?= $site->title() ?></title>
    <!-- Add your CSS and JavaScript files here -->
    <?= css('assets/css/styles.css') ?>
  </head>
  <body>
    <header class="py-5 md:py-10 sm:px-5">
      <nav class="flex items-center justify-between">
        <a href="<?= $site->url() ?>">
          <img 
            src="<?= $site->logo()->toFile()->url() ?>" alt="<?= $site->title() ?>" 
            class="h-8"
          >
        </a>
        <button id="menu-button" class="text-white hover:text-yellow-500">
          <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor">
            <line x1="2" y1="9" x2="22" y2="9" strokeLinecap="round" strokeLinejoin="round" />
            <line x1="10" y1="15" x2="22" y2="15" strokeLinecap="round" strokeLinejoin="round" />
          </svg>          
        </button>
        <?php snippet('menu') ?>
      </nav>
    </header>