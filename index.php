<?php

require_once 'config/config.php';
require_once 'controllers/MovieController.php';

header("Content-Type: application/json");

// Récupération de l'URI et de la méthode
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];


// clean routage with switch case
switch($path) {
    case '/':
        if ($method === 'GET') {
            echo json_encode(["message" => "API Films opérationnelle"]);
        }
    case '/movies':
        if ($method === 'GET') {
            $type = $_GET['type'] ?? 'popular';
            MovieController::list($type);
        }
    case '/favorites':
        if ($method === 'POST') {
            MovieController::addFavorite();
        } else if ($method === 'GET') {
            MovieController::getFavorites();
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(["erreurs" => "Ressource inexistante"]);
}



