    <footer class="flex flex-col items-center py-10">
      <div class="text-2xl flex gap-5">
        <?php snippet('components/socialLinks') ?>
        <?php snippet('components/toggleLanguage') ?>      
      </div>
      <div class="text-center py-10">
        <?= $site->footerText() ?>
      </div>
      <p>&copy; <?= date('Y') ?> Kalker Freiheit</p>
    </footer>
  </body>
</html>