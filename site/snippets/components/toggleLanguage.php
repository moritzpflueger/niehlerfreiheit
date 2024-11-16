<ul class="flex gap-3 items-center">
  <?php foreach ($kirby->languages() as $language): ?>
    <li <?php e($kirby->language() != $language, ' class="underline"') ?>>
      <a href="<?= $language->url() ?>" hreflang="<?= $language->code() ?>">
        <?= html($language->name()) ?>
      </a>
    </li>
    <li class="last:hidden">|</li>
  <?php endforeach ?>
</ul>