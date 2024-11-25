<?php snippet('header') ?>
<section class="mb-32 w-full p-">
  <article class="">
    <div class="grid sm:grid-cols-2 border-b border-neutral-700">
      <?php if ($page->files()->valid()): ?>
        <img
          src="<?= $page->files()->first()->url() ?>"
          alt="<?= $page->files()->first()->alt() ?>"
          class="w-full">
      <?php else: ?>
        <img
          src="<?= $site->placeholderImage()->toFile()->url() ?>"
          alt="Placeholder"
          class="w-full">
      <?php endif; ?>
      <div class="sm:border-l border-t sm:border-t-0 border-neutral-700 flex items-start justify-center flex-col p-10">
        <h2 class="text-4xl lg:text-6xl uppercase font-bold tracking-tight"><?= $page->title()->html() ?></h2>
      </div>
    </div>
    <div class="px-3 py-2">
      <p class="">
        Date: <?= $page->date()->toDate('E dd MMMM') ?>
      </p>
      <p class="">
        Admission: <?= $page->admissiontime()->toDate('H:mm') ?>
      </p>
      <p class="mb-5">
        Start: <?= $page->starttime()->toDate('H:mm') ?>
      </p>
      <?php if ($page->eventCode()->isNotEmpty()): ?>
        <div class="mb-5">
          <h3 class="">
            <?= t('event.eventCode') ?>
          </h3>
          <a class="underline" href="https://baramendederwelt.com/">https://baramendederwelt.com/</a>
          <p class="">
            Code: "<?= $page->eventCode()->html() ?>"
          </p>
        </div>
      <?php endif; ?>
      <div class="kirbytext normal-case">
        <?= $page->text()->kirbyText() ?>
      </div>
    </div>
  </article>
</section>
<?php snippet('footer') ?>