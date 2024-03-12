    <footer class="flex flex-col items-center py-10 text-neutral-400">
      <div class="text-2xl flex gap-5">
        <?php snippet('components/socialLinks') ?>
        <?php snippet('components/toggleLanguage') ?>      
      </div>
      <ul class="flex flex-col sm:flex-row justify-between w-full gap-5 sm:gap-20 py-10">
        <li class="">
          <ul>
            <li>
              <a href="<?= $site->url() ?>/mitmachen">About</a>
            </li>
            <li>
              <a href="<?= $site->url() ?>/mitmachen">About</a>
            </li>
            <li>
              <a href="<?= $site->url() ?>/mitmachen">AboutAboutAbout</a>
            </li>
            <li>
              <a href="<?= $site->url() ?>/mitmachen">About</a>
            </li>
            <li>
              <a href="<?= $site->url() ?>/mitmachen">AboutAbout</a>
            </li>
          </ul>
        </li>
        <li class="">
          <ul>
            <li>
              <a href="<?= $site->url() ?>/contact">Unterstützen</a>
            </li>
            <li>
              <a href="<?= $site->url() ?>/contact">Unterstützen</a>
            </li>
            <li>
              <a href="<?= $site->url() ?>/contact">Unterstützen</a>
            </li>
            <li>
              <a href="<?= $site->url() ?>/contact">Unterstützeeeeen</a>
            </li>
            <li>
              <a href="<?= $site->url() ?>/contact">Unterstützen</a>
            </li>
          </ul>
        </li>
        <li class="">
          <ul>
            <li>
              <a href="<?= $site->url() ?>/verein">Lorem ipsum dolor sit amet, consetetur sadipscing elitr</a>
            </li>
            <li>
              <a href="<?= $site->url() ?>/verein">Consetetur sadipscing elitr</a>
            </li>
            <li>
              <a href="<?= $site->url() ?>/verein">Sit amet, consetetur sadipscing elitr</a>
            </li>
            <li>
              <a href="<?= $site->url() ?>/verein">Lorem ipsum dolor sit amet</a>
            </li>
            <li>
              <a href="<?= $site->url() ?>/verein">Lorem ipsum dolor</a>
            </li>
          </ul>
        </li>
      </ul>
      <ul class="flex flex-col sm:flex-row sm:gap-10 w-full">
        <li>
          <a href="<?= $site->url() ?>/impressum">Impressum</a>
        </li>
        <li>
          <a href="<?= $site->url() ?>/datenschutz">Datenschutzerklärung</a>
        </li>        
        <li class="sm:ml-auto">
          &copy; <?= date('Y') ?> Kalker Freiheit
        </li>
      </ul>
    </footer>
  </body>
</html>