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
    <title>Niehler Freiheit e.V.</title>
    <!-- Add your CSS and JavaScript files here -->
    <?= css('assets/css/styles.css') ?>
  </head>
  <body>
    <header class="max-w-4xl w-full mx-auto py-5 md:py-10">
      test4
      <nav class="flex items-start justify-between">
        <a href="<?= $site->url() ?>">
          <img 
            src="<?= $site->logo()->toFile()->url() ?>" alt="<?= $site->title() ?>" 
            class="h-20"
          >
        </a>
        <button id="menu-button" class="text-white hover:text-yellow-500">
          <?= file_get_contents(kirby()->root('assets') . '/icons/menu.svg'); ?>          
        </button>
        <?php snippet('menu') ?>
      </nav>
    </header>