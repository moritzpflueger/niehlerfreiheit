<?php
// Temporary debug file - DELETE AFTER FIXING
// Access at: https://your-site.vercel.app/debug-config

$kirby = kirby();

// Check authentication
if (!$kirby->user()) {
    die('Unauthorized - Please log in to the panel first');
}

echo "<h1>Brevo Configuration Debug</h1>";
echo "<pre>";

echo "=== Environment Variables (getenv) ===\n";
echo "BREVO_API_KEY: " . (getenv('BREVO_API_KEY') ? substr(getenv('BREVO_API_KEY'), 0, 10) . '...' : 'NOT SET') . "\n";
echo "BREVO_SENDER_EMAIL: " . (getenv('BREVO_SENDER_EMAIL') ?: 'NOT SET') . "\n";
echo "\n";

echo "=== Environment Variables (\$_ENV) ===\n";
echo "BREVO_API_KEY: " . (isset($_ENV['BREVO_API_KEY']) ? substr($_ENV['BREVO_API_KEY'], 0, 10) . '...' : 'NOT SET') . "\n";
echo "BREVO_SENDER_EMAIL: " . ($_ENV['BREVO_SENDER_EMAIL'] ?? 'NOT SET') . "\n";
echo "\n";

echo "=== Server Variables (\$_SERVER) ===\n";
echo "BREVO_API_KEY: " . (isset($_SERVER['BREVO_API_KEY']) ? substr($_SERVER['BREVO_API_KEY'], 0, 10) . '...' : 'NOT SET') . "\n";
echo "BREVO_SENDER_EMAIL: " . ($_SERVER['BREVO_SENDER_EMAIL'] ?? 'NOT SET') . "\n";
echo "\n";

echo "=== Kirby Options ===\n";
echo "brevo_api_key exists: " . ($kirby->option('brevo-newsletter.brevo_api_key') ? 'YES' : 'NO') . "\n";
echo "brevo_api_key value: " . ($kirby->option('brevo-newsletter.brevo_api_key') ? substr($kirby->option('brevo-newsletter.brevo_api_key'), 0, 10) . '...' : 'NOT SET') . "\n";
echo "sender_email: " . ($kirby->option('brevo-newsletter.sender_email') ?: 'NOT SET') . "\n";
echo "list_ids: " . json_encode($kirby->option('brevo-newsletter.list_ids')) . "\n";
echo "\n";

echo "=== PHP Info ===\n";
echo "PHP Version: " . PHP_VERSION . "\n";
echo "Server: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') . "\n";

echo "</pre>";

echo "<p style='color: red; font-weight: bold;'>⚠️ DELETE this file after debugging!</p>";

