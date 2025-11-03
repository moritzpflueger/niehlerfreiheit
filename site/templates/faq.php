<?php snippet('header') ?>

<section class="flex-1">
  <h1 class="px-3 py-2"><?= $page->heading() ?></h1>
  <ul>
    <?php foreach ($page->faqs()->toStructure() as $faq): ?>
      <li class="first:border-t border-b border-neutral-700 px-3 py-2">
        <details>
          <summary class="cursor-pointer"><?= $faq->question() ?></summary>
          <div class="kirbytext normal-case px-3 py-5 max-w-2xl">
            <?= $faq->answer()->kirbyText() ?>
          </div>
        </details>
      </li>
    <?php endforeach; ?>
  </ul>
</section>

<?php snippet('footer') ?>