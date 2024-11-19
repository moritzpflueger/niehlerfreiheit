    <footer class="grid sm:grid-cols-2 gap-y-8 border-t border-neutral-700">


      <div class="flex flex-col gap-y-8 col-span-1 sm:border-r border-neutral-700 px-3 py-2">
        <ul>
          <li>
            <ul>
              <?php
              $menuItems = $site->menu()->toPages();
              foreach ($menuItems as $item):
              ?>
                <li class="hover:text-yellow-500">
                  <a href="<?= $site->url() ?>/<?= $item->uri() ?>">
                    <?= $item->title() ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </li>
        </ul>
        <ul class="flex flex-col w-full">
          <li>
            <a href="<?= $site->url() ?>/events?showPastEvents=true"><?= $kirby->language()->code() === 'en' ? 'Archive' : 'Archiv' ?></a>
          </li>
          <li>
            <a href="<?= $site->find('impressum')->url() ?>"><?= $site->find('impressum')->title() ?></a>
          </li>
          <li>
            <a href="<?= $site->find('datenschutzerklaerung')->url() ?>"><?= $site->find('datenschutzerklaerung')->title() ?></a>
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