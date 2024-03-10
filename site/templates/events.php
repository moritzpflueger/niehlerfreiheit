<?= snippet('header') ?>
<!-- <h1 class="text-5xl my-10"><?= $page->title() ?></h1> -->
<?= snippet('components/events/list', ['rows' => 10, 'groupByMonth' => true]) ?>
<?= snippet('footer') ?>

