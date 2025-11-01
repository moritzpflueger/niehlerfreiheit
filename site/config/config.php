<?php

return [
  'debug' => false,
  'panel' => [
    'install' => true
  ],
  'languages' => true,
  'language.detect' => true,
  'date.handler' => 'intl',
  'd4l.static_site_generator.endpoint' => 'generate-static-site',
  
  // Brevo Newsletter Configuration
  // For localhost development, values are loaded from .env file
  // For production, set these values directly or use environment variables
  'brevo-newsletter' => [
    'brevo_api_key' => null, // Set in config.localhost.php or production config
    'sender_email' => null, // Set in config.localhost.php or production config
    'sender_name' => 'Niehler Freiheit',
    'test_email' => null, // Set in config.localhost.php or production config
    'list_ids' => [
      // Add your Brevo contact list IDs (e.g., [2, 5])
      // Find at: https://app.brevo.com/contact/list
    ]
  ]
];
