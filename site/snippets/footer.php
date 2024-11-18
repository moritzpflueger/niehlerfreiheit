    <footer class="grid sm:grid-cols-2 gap-y-8 border-t border-neutral-700">


      <div class="flex flex-col gap-y-8 col-span-1 sm:border-r border-neutral-700 px-3 py-2">
        <ul>
          <li>
            <ul>
              <?php
              $menuItems = [
                ['title' => $site->find('events')->title(), 'url' => $site->find('events')->url()],
                ['title' => 'Archiv', 'url' => $site->url() . '/events?showPastEvents=true'],
                ['title' => $site->find('vereinssatzung')->title(), 'url' => $site->url() . '/vereinssatzung'],

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
        </ul>
        <ul class="flex flex-col w-full">
          <li>
            <a href="<?= $site->url() ?>/impressum">Impressum</a>
          </li>
          <li>
            <a href="<?= $site->url() ?>/datenschutzerklaerung">Datenschutzerklärung</a>
          </li>
        </ul>
      </div>
      <div class="col-span-1 px-3 py-2 flex flex-col justify-between">
        <?php snippet('components/socialLinks') ?>
        <div>
          <?php snippet('components/toggleLanguage') ?>
          &copy;<?= date('Y') ?> Kalker Freiheit
        </div>
      </div>
    </footer>
    </body>

    </html>