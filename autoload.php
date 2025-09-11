<?php

spl_autoload_register(function ($class) {
    // Define an array of namespace prefixes and their base directories
    $prefixes = [
        'BeveiligingApp\\' => __DIR__ . '/',
        'App\\Controllers\\' => __DIR__ . '/Controllers/',
        'App\\Models\\' => __DIR__ . '/Models/'
    ];

    // Loop through the prefixes array
    foreach ($prefixes as $prefix => $base_dir) {
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            continue;
        }

        $relative_class = substr($class, $len);
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
        if (file_exists($file)) {
            require $file;
            return;
        }

        // Check if the file exists without the .php extension
        $file_without_extension = $base_dir . str_replace('\\', '/', $relative_class);
        if (file_exists($file_without_extension)) {
            require $file_without_extension;
            return;
        }
    }
});