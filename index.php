<?php
require_once 'config/config.php';
require_once 'controllers/MovieController.php';
require_once 'middlewares/logger.php'; 
require_once 'middlewares/cors.php'; 


header("Content-Type: application/json");


// simple routing system with switch case
$routeur = function($request) {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $method = $_SERVER['REQUEST_METHOD'];

    switch($path) {
        case '/':
            echo json_encode(["message" => "API Films opérationnelle"]);
            break;
        case '/movies':
            $type = $_GET['type'] ?? 'popular';
            MovieController::list($type);
            break;
        case '/favorites':
            if ($method === 'POST') {
                MovieController::addFavorite();
            } elseif ($method === 'DELETE') {
                MovieController::removeFavorite();
            } else {
                MovieController::getFavorites();
            }
            break;
        default:
            http_response_code(404);
            echo json_encode(["erreurs" => "Ressource inexistante"]);
    }
};


$api = $logger($cors($routeur)); 

$api($_REQUEST);