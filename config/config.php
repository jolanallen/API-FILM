<?php



// Chargement manuel du fichier .env
if (file_exists(__DIR__ . '/../.env')) {
    $lines = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value);
    }
}

if (!defined('TMDB_API_KEY')) {
    define('TMDB_API_KEY', $_ENV['TMDB_API_KEY'] ?? '');
}

if (!defined('TMDB_BASE_URL')) {
    define('TMDB_BASE_URL', $_ENV['TMDB_BASE_URL'] ?? 'https://api.themoviedb.org/3');
}

if (!defined('APP_URL')) {
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    define('APP_URL', $protocol . "://" . $host);
}

