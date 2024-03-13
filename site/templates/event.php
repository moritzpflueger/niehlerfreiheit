<?php snippet('header') ?>
  <section class="mb-32">
    <article class="">
      <?php if ($page->files()->valid()): ?>
        <img 
          src="<?= $page->files()->first()->url() ?>" 
          alt="<?= $page->files()->first()->alt() ?>" 
          class="mb-10 w-full"
        >
      <?php else: ?>
        <img 
          src="<?= $site->placeholderImage()->toFile()->url() ?>" 
          alt="Placeholder" 
          class=""
        >
      <?php endif; ?>
      <div class="my-10">
        <p class="uppercase sm:text-2xl mb-5 inline-flex">
          <?= $page->date()->toDate('E dd MMMM') ?>
        </p>
        <h2 class="text-4xl sm:text-6xl uppercase font-bold tracking-tight"><?= $page->title()->html() ?></h2>
      </div>
      <div class="kirbytext">
        <?= $page->text()->kirbyText() ?>
      </div>
    </article>
  </section>
<?php snippet('footer') ?>

