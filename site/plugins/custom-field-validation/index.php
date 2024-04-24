<?php
  use Kirby\Cms\App as Kirby;

  Kirby::plugin('niehlerfreiheit/custom-field-validation', [
    'hooks' => [
      'page.update:before' => function ($page, $values, $strings) {
        // Get the value of the recurrence field from the submitted values
        $recurrence = $values['recurrence'] ?? $page->recurrence()->value();

        // Define the fields that are conditionally required
        $conditionalFields = [
          'weekly' => ['recurrencedays', 'startdate', 'monthstodisplay'],
          'monthly' => ['recurrencedays', 'startdate', 'monthstodisplay']
        ];
        
        // Check requirements based on the recurrence value
        foreach ($conditionalFields as $key => $fields) {
          if ($recurrence === $key) {
            foreach ($fields as $field) {
              if (empty($values[$field])) {
                throw new Exception("The field `$field` is required when recurrence is `$key`.");
              }
            }
          }
        }            
      }
    ]
  ]);