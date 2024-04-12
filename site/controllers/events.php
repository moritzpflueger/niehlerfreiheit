<?php
  return function ($site, $page) {
    $rows = 1000; // TODO: implement pagination
    $groupByMonth = $groupByMonth ?? false;
    $showPastEvents = get('showPastEvents', false);
    $showPastEventsLink = $showPastEventsLink ?? false;
    $showYear = $showPastEvents;
    $today = date('Y-m-d');
    $selectedDateFilters = explode(',', get('filterBy', ''));
    $selectedCategoryFilters = explode(',', get('category', ''));   
    $dateFilters = [];
    $categoryFiltersNonRecurringEvents = [];
    $categoryFiltersRecurringEvents = [];
    
    // Normalize filters to ignore empty values
    $selectedDateFilters = array_filter($selectedDateFilters, fn($value) => !empty($value) && $value !== 'all');
    $selectedCategoryFilters = array_filter($selectedCategoryFilters, fn($value) => !empty($value) && $value !== 'all');    

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
      ->filterBy('recurrence', 'none')
      ->sortBy('date', $showPastEvents ? 'desc' : 'asc')
      ->limit($rows);

    foreach ($events as $event) {
      $category = strtolower($event->category());
      if (!in_array($category, $categoryFiltersNonRecurringEvents)) {
        $categoryFiltersNonRecurringEvents[] = $category;
      }
    }
    
    $virtualEvents = $site->generateRecurringEvents($page);  

    foreach ($virtualEvents as $event) {
      $category = strtolower($event->category());
      if (!in_array($category, $categoryFiltersRecurringEvents)) {
        $categoryFiltersRecurringEvents[] = $category;
      }
    }  

    foreach ($virtualEvents as $event) {
      $events->add($event);
    }

    $events = $events->sortBy('date', $showPastEvents ? 'desc' : 'asc');
      
    $dateStrings = [];
    foreach ($events as $event) {
      $dateString = $event->date()->toDate('Y-MM');
      if (!in_array($dateString, $dateStrings)) {
        $dateStrings[] = $dateString;
      }
    }

    // Now, let's group these date strings by year


    foreach ($dateStrings as $dateString) {
      // Extract the year from dateString
      $year = substr($dateString, 0, 4); // Get the first four characters as year
      if (!array_key_exists($year, $dateFilters)) {
        $dateFilters[$year] = [];
      }
      $dateFilters[$year][] = $dateString;
    }
    
    $filteredEvents = $events->filter(function ($child) use ($today, $selectedDateFilters, $selectedCategoryFilters) {
        $dateFilterPassed = empty($selectedDateFilters) || in_array($child->date()->toDate('Y-MM'), $selectedDateFilters);
        $categoryFilterPassed = empty($selectedCategoryFilters) || in_array(strtolower($child->category()), $selectedCategoryFilters);
        return $dateFilterPassed && $categoryFilterPassed;
    });

    if (empty($selectedCategoryFilters) && empty($selectedDateFilters)) {
      $groupedEvents = $events->groupBy(function ($child) {
        return $child->date()->toDate('MMMM Y');
      });
    } else {
      $groupedEvents = $filteredEvents->groupBy(function ($child) {
        return $child->date()->toDate('MMMM Y');
      });
    }
    return [
      'dateFilters' => $dateFilters,
      'categoryFiltersNonRecurringEvents' => $categoryFiltersNonRecurringEvents,
      'categoryFiltersRecurringEvents' => $categoryFiltersRecurringEvents,
      'groupedEvents' => $groupedEvents,
      'selectedDateFilters' => $selectedDateFilters,
      'selectedCategoryFilters' => $selectedCategoryFilters,
      'showPastEvents' => $showPastEvents,
      'showYear' => $showYear,
    ];
  };