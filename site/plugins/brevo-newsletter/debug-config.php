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

echo "=== Environment Variables ===\n";
echo "BREVO_API_KEY exists: " . (getenv('BREVO_API_KEY') ? 'YES' : 'NO') . "\n";
echo "BREVO_API_KEY value: " . (getenv('BREVO_API_KEY') ? substr(getenv('BREVO_API_KEY'), 0, 10) . '...' : 'NOT SET') . "\n";
echo "BREVO_SENDER_EMAIL: " . (getenv('BREVO_SENDER_EMAIL') ?: 'NOT SET') . "\n";
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

