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
  'brevo-newsletter' => [
    'brevo_api_key' => $_ENV['BREVO_API_KEY'] ?? getenv('BREVO_API_KEY') ?: null,
    'sender_email' => $_ENV['BREVO_SENDER_EMAIL'] ?? getenv('BREVO_SENDER_EMAIL') ?: null,
    'sender_name' => 'Niehler Freiheit',
    'list_ids' => [4] // Your Brevo contact list ID
  ]
];
