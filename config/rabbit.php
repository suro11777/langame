<?php

return [
    'rabbit_queue' => env('RABBIT_QUEUE', 'telegram_queue'),
    'rabbit_host' => env('RABBIT_HOST', 'localhost'),
    'rabbit_port' => env('RABBIT_PORT', '5672'),
    'rabbit_user' => env('RABBIT_USER', 'guest'),
    'rabbit_password' => env('RABBIT_PASSWORD', 'guest'),
];
