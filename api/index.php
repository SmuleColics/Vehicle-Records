<?php

/**
 * Vercel serverless entry point.
 *
 * Vercel's filesystem is read-only except /tmp, so Laravel's cache files and compiled views
 * are pointed there. The rest are production defaults, any of them can be overridden from
 * the Vercel dashboard (Settings > Environment Variables).
 */
$defaults = [
    'APP_ENV' => 'production',
    'APP_DEBUG' => 'false',
    'APP_CONFIG_CACHE' => '/tmp/config.php',
    'APP_EVENTS_CACHE' => '/tmp/events.php',
    'APP_PACKAGES_CACHE' => '/tmp/packages.php',
    'APP_ROUTES_CACHE' => '/tmp/routes.php',
    'APP_SERVICES_CACHE' => '/tmp/services.php',
    'VIEW_COMPILED_PATH' => '/tmp/views',
    'LOG_CHANNEL' => 'stderr',
    'SESSION_DRIVER' => 'database',
    'CACHE_STORE' => 'array',
    'DB_CONNECTION' => 'mysql',
    // TiDB Cloud (and most hosted MySQL) only accepts TLS connections
    'MYSQL_ATTR_SSL_CA' => '/etc/pki/tls/certs/ca-bundle.crt',
    'DEMO_MODE' => 'true',
];

foreach ($defaults as $key => $value) {
    if (getenv($key) === false) {
        putenv("$key=$value");
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
}

require __DIR__ . '/../public/index.php';
