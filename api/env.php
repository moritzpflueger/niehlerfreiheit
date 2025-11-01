<?php
// This file exposes Vercel environment variables to PHP
// Vercel injects env vars into /api/* routes but not root routes

// Make these available globally
$_ENV['BREVO_API_KEY'] = getenv('BREVO_API_KEY');
$_ENV['BREVO_SENDER_EMAIL'] = getenv('BREVO_SENDER_EMAIL');

// Also set them via putenv for getenv() to work
if (getenv('BREVO_API_KEY')) {
    putenv('BREVO_API_KEY=' . getenv('BREVO_API_KEY'));
}
if (getenv('BREVO_SENDER_EMAIL')) {
    putenv('BREVO_SENDER_EMAIL=' . getenv('BREVO_SENDER_EMAIL'));
}

