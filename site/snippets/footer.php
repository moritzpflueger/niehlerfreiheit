    <footer class="flex flex-col items-center p-10 text-neutral-400">
      <div class="text-2xl flex gap-5">
        <?php snippet('components/socialLinks') ?>
        <?php snippet('components/toggleLanguage') ?>      
      </div>
      <ul class="flex flex-col md:flex-row justify-between w-full gap-5 sm:gap-20 py-10">
        <li class="">
          <ul>
            <?php 
              $menuItems = [
                ['title' => $site->find('events')->title(), 'url' => $site->find('events')->url()],
                ['title' => 'Archiv', 'url' => $site->url() . '/events?showPastEvents=true'],
                ['title' => $site->find('posts')->title(), 'url' => $site->url() . '/posts'],
                // ['title' => $site->find('location')->title(), 'url' => $site->url() . '/location'],
                ['title' => $site->find('verein')->title(), 'url' => $site->url() . '/verein'],
              ];
              foreach ($menuItems as $item):

            ?>
              <li class="hover:text-yellow-500">
                <a href="<?= $item['url'] ?>">
                  <?= $item['title'] ?>
                </a>
              </li>
            <?php endforeach; ?>
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
            <?php 
              $posts = page('posts')->children()->listed()->limit(5);
              foreach ($posts as $post):
            ?>
            <li>
              <a href="<?= $post->url() ?>"><?= $post->title()->excerpt(35) ?></a>
            </li>
            <?php endforeach; ?>
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