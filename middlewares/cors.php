<?php



$cors = function($suivant) {
    return function($request) use ($suivant) {
        header("Access-Control-Allow-Origin: " . APP_URL);
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(204);
            exit;
        }
        return $suivant($request);
    };
};
































