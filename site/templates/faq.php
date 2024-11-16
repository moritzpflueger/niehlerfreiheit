<?php snippet('header') ?>

<section class="flex-1 px-3 py-2">
  <h1><?= $page->heading() ?></h1>
  <ul>
    <?php foreach ($page->faqs()->toStructure() as $faq): ?>
      <li class="mb-5">
        <details>
          <summary class="cursor-pointer text-xl font-bold"><?= $faq->question() ?></summary>
          <p class="py-5 max-w-2xl"><?= $faq->answer() ?></p>
        </details>
      </li>
    <?php endforeach; ?>
  </ul>
</section>

<?php snippet('footer') ?>