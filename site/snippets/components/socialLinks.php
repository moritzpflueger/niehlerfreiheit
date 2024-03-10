<ul class="flex gap-3">
  <?php foreach ($site->socialLinks()->toStructure() as $link): ?>
    <li class="w-10 h-10">
      <a href="<?= $link->url() ?>" aria-label="<?= $link->name() ?>" target="_blank">
        <?= file_get_contents(kirby()->root('assets') . '/icons/social/' . $link->icon() . '.svg'); ?>
      </a>
    </li>
  <?php endforeach; ?>
</ul>