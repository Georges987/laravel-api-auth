<?php

if (php_sapi_name() == 'cli-server') {
    // Redirige toutes les requêtes non liées à des fichiers vers public/index.php
    $url = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . '/public' . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require_once __DIR__ . '/public/index.php';
