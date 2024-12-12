<?php
header('Content-type: text/xml');

echo '<?xml version="1.0" encoding="UTF-8" ?>';
?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
  <channel>
    <title><?= $site->title() ?> - Events</title>
    <link><?= $site->pages()->find('events')->url() ?></link>
    <description>Upcoming events from <?= $site->title() ?></description>
    <pubDate><?= date(DATE_RSS) ?></pubDate>
    <lastBuildDate><?= date(DATE_RSS) ?></lastBuildDate>
    <atom:link href="<?= $site->pages()->find('events')->url() ?>.xml" rel="self" type="application/rss+xml" />

    <?php foreach ($nonRecurringEvents as $event): ?>
      <item>
        <title><?= $event->title()->xml() ?></title>
        <link><?= $event->url() ?></link>
        <admissionTime><?= $event->admissiontime()->isNotEmpty() ? $event->admissiontime() : 'not set' ?></admissionTime>
        <startTime><?= $event->starttime() ?></startTime>
        <description>
          <de><?= $event->content('de')->text()->kirbytext() ?></de>
          <en><?= $event->content('en')->text()->kirbytext() ?></en>
        </description>
        <category><?= $event->category() ?></category>
        <pubDate><?= $event->date()->toDate('Y-MM-DD') ?></pubDate>
        <guid><?= $event->url() ?></guid>


        <image>
          <?php if ($event->files()->valid()): ?>
            <url><?= $event->files()->first()->url() ?></url>
            <alt><?= $event->files()->first()->alt() ?></alt>
          <?php else: ?>
            <url><?= $site->placeholderImage()->toFile()->url() ?></url>
            <alt>Placeholder</alt>
          <?php endif; ?>
        </image>
        <isCanceled><?= $event->isCanceled()->toBool() ? 'true' : 'false' ?></isCanceled>
        <eventCode><?= $event->eventCode()->isNotEmpty() ? $event->eventCode()->html() : 'not set' ?></eventCode>

      </item>
    <?php endforeach; ?>
  </channel>
</rss>