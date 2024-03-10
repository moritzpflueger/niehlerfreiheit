<ul class="flex gap-3 items-center">
  <?php foreach($kirby->languages() as $language): ?>
    <li <?php e($kirby->language() == $language, ' class="text-yellow-500"') ?> >
      <a class="uppercase font-semibold hover:text-yellow-500" href="<?= $language->url() ?>" hreflang="<?= $language->code() ?>">
        <?= html($language->code()) ?>
      </a>
    </li>
  <?php endforeach ?>
</ul>   