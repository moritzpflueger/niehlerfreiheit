<?php

return [
  'debug' => true, // Enable for staging
  
  // Brevo Newsletter - Staging configuration
  // NOTE: Hardcoded because Vercel PHP runtime doesn't expose environment variables properly
  // For production, use environment variables or a separate config file
  'brevo-newsletter' => [
    'brevo_api_key' => 'YOUR_BREVO_API_KEY_HERE', // TODO: Replace with actual key
    'sender_email' => 'hello@niehlerfreiheit.de', // TODO: Replace with actual email
    'sender_name' => 'Niehler Freiheit',
    'list_ids' => [4]
  ]
];

