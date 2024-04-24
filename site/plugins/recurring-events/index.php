<?php
  use Kirby\Cms\App as Kirby;
  use Recurr\Rule;
  use Recurr\Transformer\ArrayTransformer;
  use Recurr\Transformer\Constraint\AfterConstraint;
  require_once __DIR__ . '/models/VirtualEventPage.php';

  Kirby::plugin('niehlerfreiheit/recurring-events', [
      'pageModels' => [
        'VirtualEventPage' => VirtualEventPage::class
      ],
      'siteMethods' => [
        'generateRecurringEvents' => function ($page) {
            
          $today = date('Y-m-d');
          $virtualEvents = [];
          $recurringEvents = $page
            ->children()
            ->listed()
            ->filterBy('recurrence', '!=', 'none');

          foreach ($recurringEvents as $event) {
              $startDate = $event->startdate(); // Start date and time
              $endDate = null;
              $until = date('Y-m-d', strtotime('+' . $event->monthsToDisplay() . 'months'));
              $frequency = $event->recurrence(); // 'weekly' | 'monthly'
              $interval = $event->isBiweekly()->toBool() ? 2 : 1;
              $weekOfMonth = $event->weekOfMonth()->yaml();

              if ($frequency == 'monthly') {
                $recurrenceDays = $event->recurrenceDays()->split(); // kirby's checkbox field returns an comma separated string of values
                $weekOfMonth = $event->weekOfMonth()->split(); // kirby's checkbox field returns an comma separated string of values
                $byDays = [];
                foreach($weekOfMonth as $week) {
                  foreach($recurrenceDays as $day) {
                    $byDays[] = $week . $day;
                  }
                }
                $byday = str_replace(' ', '', implode(',', $byDays)); // Convert array back to comma-separated string
              } else {
                $byday = str_replace(' ', '', implode(',', $event->recurrenceDays()->yaml()));
              }

              $ruleString = "FREQ=$frequency;UNTIL=$until;INTERVAL=$interval;BYDAY=$byday;";
              $rule = new Rule($ruleString, $startDate, $endDate, 'Europe/Berlin'); // Adjust timezone if necessary

              $transformer = new ArrayTransformer();
              $constraint = new AfterConstraint(new \DateTime($today), true);
              $occurrences = $transformer->transform($rule, $constraint);

              foreach ($occurrences as $occurrence) {
                $date = $occurrence->getStart()->format('Y-m-d');
                $virtualEvent = new VirtualEventPage([
                  'slug' => $event->slug() . '-' . $date,
                  'template' => 'event',
                  'model' => 'virtualevent',
                  'content' => [
                    'title' => $event->title(),
                    'date' => $date,
                    'starttime' => $event->starttime(),
                    'text' => $event->text(),
                    'category' => $event->category(),
                  ],
                  'parent' => $event,
                ]);         
                
                $canceledDates = array_column($event->canceledDates()->yaml(), 'date');
                $isCanceled = in_array($date, $canceledDates); // Ensure $date is formatted as 'Y-m-d'
                $virtualEvent->setIsCanceled($isCanceled);
                $virtualEvents[] = $virtualEvent;
              }
            }                

          return $virtualEvents;
        }
      ]
  ]);