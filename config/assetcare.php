<?php

return [
    'user' => env('ADMIN_USER', 'admin'),
    'pass' => env('ADMIN_PASS', 'admin123'),
    'base_url' => env('QR_BASE_URL'),
//added when warranty alert is works
    'alert_email' => env('ALERT_EMAIL', 'admin@example.com'),
];