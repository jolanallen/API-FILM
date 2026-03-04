# API Film REST PHP

Ce projet est une API REST simple développée en PHP pour récupérer des informations sur les films via l'API TMDB et gérer une liste de favoris locale.

## Installation

1. Clonez le dépôt ou téléchargez les fichiers.
2. Copiez le fichier `.env.example` vers `.env` :
   ```bash
   cp .env.example .env
   ```
3. Modifiez le fichier `.env` pour y ajouter votre clé API TMDB (`TMDB_API_KEY`).

## Lancement du serveur

Utilisez le serveur intégré de PHP :
```bash
php -S localhost:8000
```

## Routes disponibles

- **GET `/`** : Vérifie si l'API est opérationnelle.
- **GET `/movies?type={type}`** : Récupère la liste des films depuis TMDB.
  - `type` par défaut : `popular`. Autres options : `top_rated`, `upcoming`, `now_playing`.
- **POST `/favorites`** : Ajoute un film aux favoris (sauvegardé dans `favorites.json`).
  - Corps de la requête (JSON) : `{"id": 550, "title": "Fight Club"}`

## Tests

Une collection Bruno est disponible dans le dossier `bruno-collections`. Importez ce dossier dans [Bruno](https://www.usebruno.com/) pour tester facilement les endpoints.

## Structure du projet

- `config/` : Configuration et constantes.
- `controllers/` : Logique de traitement des requêtes.
- `services/` : Appels aux API externes (TMDB).
- `bruno-collections/` : Fichiers de test pour Bruno.
- `index.php` : Point d'entrée et routeur de l'API.
