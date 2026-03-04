<?php

require_once __DIR__ . '/../services/TMDBService.php';

class MovieController {
    public static function list($type) {
        $movies = TMDBService::getMovies($type);
        if ($movies === null) {
            http_response_code(500);
            echo json_encode(["error" => "Erreur lors de la récupération des films auprès de TMDB"]);
            return;
        }

        echo json_encode($movies);
    }

    public static function addFavorite() {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        if (!$data || !isset($data['id']) || !isset($data['title'])) {
            http_response_code(400);
            echo json_encode(["error" => "Données invalides. Un 'id' et un 'title' sont requis."]);
            return;
        }
        $favoritesFile = __DIR__ . '/../favorites.json';
        $favorites = [];

        if (file_exists($favoritesFile)) {
            $favorites = json_decode(file_get_contents($favoritesFile), true) ?? [];
        }


        $favorites[] = [
            'id' => $data['id'],
            'title' => $data['title'],
            'added_at' => date('Y-m-d H:i:s')
        ];

        if (file_put_contents($favoritesFile, json_encode($favorites, JSON_PRETTY_PRINT))) {
            echo json_encode(["message" => "Film ajouté aux favoris"]);

        } else {
            http_response_code(500);


            echo json_encode(["error" => "impossible de sauvegarder le favori"]);
        }
    }

    public static function getFavorites() {
        $favoritesFile = __DIR__ . '/../favorites.json';
        if (file_exists($favoritesFile)) {
            $favorites = json_decode(file_get_contents($favoritesFile), true) ?? [];


            echo json_encode($favorites);
        } else {
            echo json_encode([]); 
        };

    }

    public static function removeFavorite() {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            http_response_code(400);
            echo json_encode(["error" => "L'identifiant 'id' est requis pour supprimer un favori."]);
            return;
        }

        $favoritesFile = __DIR__ . '/../favorites.json';
        if (!file_exists($favoritesFile)) {
            http_response_code(404);
            echo json_encode(["error" => "Aucun favori trouvé."]);
            return;
        }

        $favorites = json_decode(file_get_contents($favoritesFile), true) ?? [];
        $countBefore = count($favorites);
        
        $favorites = array_filter($favorites, function($fav) use ($id) {
            return (string)$fav['id'] !== (string)$id;
        });

        $favorites = array_values($favorites);

        if (count($favorites) === $countBefore) {
            http_response_code(404);
            echo json_encode(["error" => "Favori non trouvé."]);
            return;
        }

        if (file_put_contents($favoritesFile, json_encode($favorites, JSON_PRETTY_PRINT))) {
            echo json_encode(["message" => "Film retiré des favoris"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Impossible de mettre à jour les favoris"]);
        }
    }
}
