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

<div class="h-full">
  <a href="<?= $eventUrl ?>" class="">
    <div class="border-r border-b border-neutral-700 h-full">
      <?php if ($showImage): ?>
        <div class="">
          <img class="" src="<?= $imageUrl ?>" alt="<?= $imageAlt ?>" />

        </div>
      <?php endif; ?>
      <div class="px-3 pt-3 pb-5">

        <?php $isCanceled = is_bool($event->isCanceled())
          ? $event->isCanceled()
          : $event->isCanceled()->toBool();
        if ($isCanceled): ?>

          <div class="bg-red-500 border border-red-500 px-1 text-sm uppercase text-black inline-block mb-2">
            abgesagt
          </div>
        <?php endif; ?>

        <div class="text-base text-neutral-400 uppercase mb-0">
          <?= $event->date()->toDate('E dd MMMM' . ($showYear ? ' Y' : '')) ?>
        </div>
        <h3 class="text-white"><?= $event->title()->html() ?></h3>
        <div class="mt-2">
          <div class="text-black text-sm inline-flex w-auto px-1 <?= $isRecurring ? 'bg-cyan-400' : 'bg-green-400' ?>">
            <?= $event->category() ?>
          </div>
        </div>
      </div>
    </div>
  </a>
</div>

<!-- bg-[#00538A] -->