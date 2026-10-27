<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Demo Mode
    |--------------------------------------------------------------------------
    |
    | When enabled, the landing and login pages show one-click buttons that
    | sign visitors into the shared demo accounts below. The accounts are
    | created by the database seeder (php artisan db:seed).
    |
    */

    'enabled' => (bool) env('DEMO_MODE', false),

    'accounts' => [
        'admin' => 'demo.admin@example.com',
        'client' => 'demo.client@example.com',
    ],

];
