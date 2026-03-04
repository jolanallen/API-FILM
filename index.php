<?php

require_once 'config/config.php';
require_once 'controllers/MovieController.php';

header("Content-Type: application/json");

// Récupération de l'URI et de la méthode
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Routage simple
if ($method === 'GET' && str_starts_with($path, '/movies')) {
    $type = $_GET['type'] ?? 'popular';
    MovieController::list($type);
} 
elseif ($method === 'POST' && $path === '/favorites') {
    MovieController::addFavorite();
}
elseif ($method === 'GET' && $path === '/favorites') {
    MovieController::getFavorites();
}
elseif ($path === '/') {
    echo json_encode(["message" => "API Films opérationnelle"]);
}
else {
    http_response_code(404);
    echo json_encode(["error" => "Route inconnue"]);
}
