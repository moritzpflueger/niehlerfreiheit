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
    <?php snippet('header') ?>
    <div class="">
      <div class="">
        <h1 class="text-4xl"><?= $page->title() ?></h1>
        <?= $page->text() ?>
        <?= $page->description() ?>
        <?php 
          snippet(
            'components/upcomingEvents/list', [
              'hideFirstEvent' => true, 
              'rows' => 3
          ]) 
        ?>    
        <p class="py-10">
          <?= $site->infoText()->kirbytext() ?>
        </p>    
      </div>  
    </div>
    <?php snippet('footer') ?>
  </body>
</html>

