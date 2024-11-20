<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="<?= $kirby->url() . '/assets/icons/favicon.ico' ?>" type="image/x-icon">
  <link rel="apple-touch-icon" sizes="180x180" href="assets/icons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/icons/favicon-16x16.png">
  <link rel="mask-icon" href="assets/icons/safari-pinned-tab.svg" color="#000000">
  <meta name="msapplication-TileColor" content="#000000">
  <meta name="theme-color" content="#000000">
  <title>Niehler Freiheit e.V.</title>
  <!-- Add your CSS and JavaScript files here -->
  <?= css('assets/css/styles.css') ?>
</head>

<body>
  <header class="">
    <a href="<?= $site->url() ?>" class="block border-b border-neutral-700 px-3 py-2">
      niehler freiheit e.V.
    </a>
    <nav class="flex items-start justify-between px-3 py-2 border-b border-neutral-700">
      <!-- <button id="menu-button" class="text-white hover:text-primary">
        <?= file_get_contents(kirby()->root('assets') . '/icons/menu.svg'); ?>
      </button> -->
      <?php snippet('menu') ?>
    </nav>
  </header>