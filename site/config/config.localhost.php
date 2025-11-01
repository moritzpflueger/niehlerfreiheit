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
    'test_email' => $_ENV['BREVO_TEST_EMAIL'] ?? null,
    // Check your Brevo list ID at https://app.brevo.com/contact/list
    'list_ids' => [4],
    // Image base URL for emails (use production URL so images work in emails)
    // Leave null to use site URL, or set to production: 'https://niehlerfreiheit.de'
    'image_base_url' => $_ENV['BREVO_IMAGE_BASE_URL'] ?? null,
    
    // Optional: Brevo template ID for drag-and-drop editing
    // Create a template in Brevo and paste the ID here
    // Leave null to use HTML campaigns (HTML editor only)
    'template_id' => 50,
  ]
];
