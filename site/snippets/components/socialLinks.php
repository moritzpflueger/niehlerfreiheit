<ul>
  <?php foreach ($site->socialLinks()->toStructure() as $link): ?>
    <li>
      <a href="<?= $link->url() ?>" aria-label="<?= $link->name() ?>" target="_blank">
        <?= $link->name() ?>
      </a>
    </li>
  <?php endforeach; ?>
</ul>