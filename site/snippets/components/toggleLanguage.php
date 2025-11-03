<ul class="flex gap-3 items-center">
  <?php foreach ($kirby->languages() as $language): ?>
    <li <?php e($kirby->language() == $language, 'class="underline pointer-events-none"') ?>>
      <?php if ($kirby->language() == $language): ?>
        <?= html($language->name()) ?>
      <?php else: ?>
        <a href="<?= $language->url() ?>" hreflang="<?= $language->code() ?>">
          <?= html($language->name()) ?>
        </a>
      <?php endif; ?>
    </li>
    <li class="last:hidden">|</li>
  <?php endforeach ?>
</ul>