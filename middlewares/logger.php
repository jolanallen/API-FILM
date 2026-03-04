<?php


///middleware pou rlogger l'ensembles de requête api 

$logger = function($suivant) {
    return function($request) use ($suivant) {
        date_default_timezone_set('Europe/Paris');  // initialisation de l'ehure au fuseau europe paris

        $method = $_SERVER['REQUEST_METHOD'] ?? 'N/A';
        $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';

        $uri    = $_SERVER['REQUEST_URI'] ?? 'N/A';
        
        
        $time   = date('H:i:s');

        
        file_put_contents('php://stdout', "\033[34m[LOG $time]\033[0m \033[1;37m[IP $ip]\033[0m \033[31m$method $uri\033[0m\n"); // vive la france
        return $suivant($request);
    };
};