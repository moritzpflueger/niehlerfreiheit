    <footer class="grid sm:grid-cols-2 border-t border-neutral-700">


      <div class="flex flex-col gap-y-8 col-span-1 sm:border-r border-neutral-700 px-3 py-2 justify-between">
        <ul>
          <li>
            <ul>
              <?php
              $menuItems = $site->menu()->toPages();
              foreach ($menuItems as $item):
              ?>
                <li class="hover:text-primary">
                  <a href="<?= $site->url() ?>/<?= $item->uri() ?>">
                    <?= $item->title() ?>
                  </a>
                </li>
              <?php endforeach; ?>
              <li class="hover:text-primary">
                <a href="/#newsletter">
                  newsletter
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>

      <div class="flex flex-col-reverse sm:flex-col gap-y-4 sm:gap-y-8 col-span-1 px-3 py-2 justify-between">
        <?php snippet('components/socialLinks') ?>
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

      <div class="col-span-1 px-3 py-2 sm:border-r border-neutral-700">
        <?php snippet('components/toggleLanguage') ?>
        <div>&copy;<?= date('Y') ?> Niehler Freiheit</div>
      </div>

      <div class="col-span-1 px-3 py-2 flex items-end">
        <span>
          Made with ♥ by <a class="inline-block underline" href="https://www.moritzpflueger.com/en/">Moritz Pflüger</a>
        </span>
      </div>
    </footer>
    </body>

    </html>