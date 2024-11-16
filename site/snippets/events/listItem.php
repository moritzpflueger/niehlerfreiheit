<?php
$isRecurring = method_exists($event, 'isRecurring') && $event->isRecurring();
$files = $isRecurring ? $event->parent()->files() : $event->files();
$eventUrl = $isRecurring ? $event->parent()->url() : $event->url();

$isValid = $files->valid();
$placeholderUrl = $site->placeholderImage()->toFile()->url();
if ($isValid) {
  $imageUrl = $files->first()->url();
  $imageAlt = $files->first()->alt();
} else {
  $imageUrl = $placeholderUrl;
  $imageAlt = 'Placeholder Image';
};
$highlightFeaturedEvent = $highlightFeaturedEvent ?? false;
$showYear = $showYear ?? false;
$showImage = $showImage ?? true;
$showDivider = $showDivider ?? false;
?>

<div class="flex sm:basis-1/2 lg:basis-1/3 xl:basis-1/5 flex-col items-start border-r border-t first:border-l border-neutral-700">
  <?php if ($showImage): ?>
    <div class="">
      <a href="<?= $eventUrl ?>" class="">
        <img class="rounded-sm" src="<?= $imageUrl ?>" alt="<?= $imageAlt ?>" />
      </a>
    </div>
  <?php endif; ?>
  <div class="p-3">
    <div class="mb-2">
      <div class="uppercase text-black text-sm inline-flex w-auto px-1 <?= $isRecurring ? 'bg-cyan-500' : 'bg-lime-600' ?>">
        <?= $event->category() ?>
      </div>
      <?php $isCanceled = is_bool($event->isCanceled())
        ? $event->isCanceled()
        : $event->isCanceled()->toBool();
      if ($isCanceled): ?>
        <div class="bg-red-500 border border-red-500 px-1 text-sm uppercase text-black inline-block">
          abgesagt
        </div>
      <?php endif; ?>
    </div>
    <h3 class="text-white"><?= $event->title()->html() ?></h3>
    <span class="text-base text-neutral-400 uppercase mb-0">
      <?= $event->date()->toDate('E dd MMMM' . ($showYear ? ' Y' : '')) ?>
    </span>
    <div class="my-5">
      <?php if (!$event->admissiontime()->isEmpty()): ?>
        <p class="text-neutral-400"><?= t('event.admissionTime') . ': ' . $event->admissionTime()->toDate('HH:mm') ?></p>
      <?php endif ?>
      <p class="text-neutral-400 mb-3"><?= t('event.startTime') . ': ' . $event->starttime()->toDate('HH:mm') ?></p>
      <!-- <p class="text-neutral-400">
        <?= $event->text()->excerpt(300) ?>
        <a href="<?= $eventUrl ?>" class="text-yellow-500 hover:underline flex items-center">
          Event öffnen
          <span class="w-10 ml-3">
            <?= file_get_contents(kirby()->root('assets') . '/icons/arrowRight.svg'); ?>
          </span>
        </a>
      </p>           -->
    </div>
  </div>
</div>
<?php if ($showDivider): ?>
  <hr class="border-neutral-700 invisible sm:visible" />
<?php endif; ?>

<!-- bg-[#00538A] -->