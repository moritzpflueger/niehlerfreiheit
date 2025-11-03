<?php

// Load environment variables from .env file
$envFile = dirname(__DIR__, 2) . '/.env';
if (file_exists($envFile)) {
  $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
  $dotenv->load();
}

return [
  'debug' => true,
  
  // Brevo Newsletter - using .env variables
  'brevo-newsletter' => [
    'brevo_api_key' => $_ENV['BREVO_API_KEY'] ?? null,
    'sender_email' => $_ENV['BREVO_SENDER_EMAIL'] ?? null,
    'sender_name' => 'Niehler Freiheit',
    'list_ids' => [4]
  ]
];
