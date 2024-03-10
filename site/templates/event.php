<?php snippet('header') ?>
  <section class="my-32">
    <article class="flex flex-col gap-5">
      <div class="">
        <p class="font-bold uppercase text-4xl mb-5">
          <?= $page->date()->toDate('E dd MMMM') ?>
        </p>
        <h2 class="text-5xl"><?= $page->title()->html() ?></h2>
      </div>
      <?php if ($page->files()->valid()): ?>
        <img 
          src="<?= $page->files()->first()->url() ?>" 
          alt="<?= $page->files()->first()->alt() ?>" 
          class="my-10"
        >
      <?php else: ?>
        <img 
          src="<?= $site->placeholderEventImage()->toFile()->url() ?>" 
          alt="Placeholder" 
          class=""
        >
      <?php endif; ?>
      <?= $page->description()->kirbyText() ?>
    </article>
  </section>
<?php snippet('footer') ?>

