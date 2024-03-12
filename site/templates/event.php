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
        <p class="font-bold uppercase text-4xl mb-5">
          <?= $page->date()->toDate('E dd MMMM') ?>
        </p>
        <h2 class="text-5xl"><?= $page->title()->html() ?></h2>
      </div>
      <div class="kirbytext">
        <?= $page->text()->kirbyText() ?>
      </div>
    </article>
  </section>
<?php snippet('footer') ?>

