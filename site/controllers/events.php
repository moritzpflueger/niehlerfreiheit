<?php
  return function ($page) {
    $rows = 1000; // TODO: implement pagination
    $groupByMonth = $groupByMonth ?? false;
    $showPastEvents = get('showPastEvents', false);
    $showPastEventsLink = $showPastEventsLink ?? false;
    $showYear = $showPastEvents;
    $today = date('Y-m-d');

    // Filter for future events, sort them by date, and limit to number of rows given
    $events = $page
      ->children()
      ->listed()
      ->filter(function($child) use ($today, $showPastEvents) {
        if ($showPastEvents) { 
          return $child->date()->toDate('YYYY-MM-dd') < $today;
        }
        return $child->date()->toDate('YYYY-MM-dd') >= $today;
      })
      ->sortBy('date', $showPastEvents ? 'desc' : 'asc')
      ->limit($rows);

    $dateStrings = [];
    foreach ($events as $event) {
      $dateString = $event->date()->toDate('Y-MM');
      if (!in_array($dateString, $dateStrings)) {
        $dateStrings[] = $dateString;
      }
    }

    $selectedFilter = get('filterBy', null);
    
    $filteredEvents = $events->filter(function($child) use ($selectedFilter) {
      return $child->date()->toDate('Y-MM') === $selectedFilter;
    });  

    if ($filteredEvents->count() > 0) {
      $groupedEvents = $filteredEvents->groupBy(function ($child) {
        return $child->date()->toDate('MMMM Y');
      });
    } else {
      $groupedEvents = $events->groupBy(function ($child) {
        return $child->date()->toDate('MMMM Y');
      });
    }
    return [
      'dateStrings' => $dateStrings,
      'groupedEvents' => $groupedEvents,
      'selectedFilter' => $selectedFilter,
      'showPastEvents' => $showPastEvents,
      'showYear' => $showYear,
    ];
  };