<?php

return [
  'debug' => true, // Enable for staging
  
  // Brevo Newsletter - Staging configuration
  'brevo-newsletter' => [
    'brevo_api_key' => getenv('BREVO_API_KEY') ?: $_ENV['BREVO_API_KEY'] ?? $_SERVER['BREVO_API_KEY'] ?? null,
    'sender_email' => getenv('BREVO_SENDER_EMAIL') ?: $_ENV['BREVO_SENDER_EMAIL'] ?? $_SERVER['BREVO_SENDER_EMAIL'] ?? null,
    'sender_name' => 'Niehler Freiheit',
    'list_ids' => [4]
  ]
];

