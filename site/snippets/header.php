<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="assets/icons/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/icons//apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/icons//favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/icons//favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="assets/icons//safari-pinned-tab.svg" color="#000000">
    <meta name="msapplication-TileColor" content="#000000">
    <meta name="theme-color" content="#000000">  
    <title><?= $site->title() ?></title>
    <!-- Add your CSS and JavaScript files here -->
    <?= css('assets/css/styles.css') ?>
  </head>
  <body>
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