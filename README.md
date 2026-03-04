# API Film REST PHP

Ce projet est une API REST simple développée en PHP pour récupérer des informations sur les films via l'API TMDB et gérer une liste de favoris locale.

## Installation

1. Clonez le dépôt ou téléchargez les fichiers.
2. Installez les dépendances (nécessaire pour les tests) :
   ```bash
   composer install
   ```
3. Copiez le fichier `.env.example` vers `.env` :
   ```bash
   cp .env.example .env
   ```
4. Modifiez le fichier `.env` pour y ajouter votre clé API TMDB (`TMDB_API_KEY`).

## Lancement du serveur

Utilisez le serveur intégré de PHP :
```bash
php -S localhost:8000
```

## Sécurité & Middlewares

L'API intègre une couche de middlewares pour assurer un minimum de sécurité et de traçabilité :

- **CORS (Cross-Origin Resource Sharing)** : Le middleware `cors.php` restreint l'accès à l'API. Par défaut, il n'autorise que les requêtes provenant de l'URL définie par `APP_URL`. Il gère également les requêtes de pré-vérification (`OPTIONS`).
- **Logger** : Le middleware `logger.php` enregistre chaque requête entrante (Méthode, URI, IP et Heure) directement dans la sortie standard (ou les logs du serveur), permettant une surveillance en temps réel de l'activité.
- **Variables d'environnement** : Les informations sensibles (comme la clé API TMDB) ne sont jamais stockées en dur dans le code, mais chargées via un fichier `.env` non versionné.

## Routes disponibles

- **GET `/`** : Vérifie si l'API est opérationnelle.
- **GET `/movies?type={type}`** : Récupère la liste des films depuis TMDB.
  - `type` par défaut : `popular`. Autres options : `top_rated`, `upcoming`, `now_playing`.
- **POST `/favorites`** : Ajoute un film aux favoris (sauvegardé dans `favorites.json`).
  - Corps de la requête (JSON) : `{"id": 550, "title": "Fight Club"}`
- **GET `/favorites`** : Liste tous les films favoris.
- **DELETE `/favorites?id={id}`** : Retire un film des favoris par son identifiant.

## Tests

### 1. Tests manuels avec Bruno
Une collection Bruno est disponible dans le dossier `bruno-collections`.
1. Téléchargez et installez [Bruno](https://www.usebruno.com/).
2. Importez le dossier `bruno-collections` comme une nouvelle collection.
3. Vous pouvez maintenant tester chaque endpoint visuellement.

### 2. Tests automatisés avec PHPUnit
Le projet inclut des tests unitaires et d'intégration pour garantir la stabilité du code.
Pour lancer les tests :
```bash
vendor/bin/phpunit
```

## Intégration Continue (CI/CD)
Le projet utilise **GitHub Actions** pour :
- Vérifier la syntaxe PHP (Linting).
- Exécuter les tests PHPUnit automatiquement à chaque push.
- Créer une release GitHub automatiquement lors de l'ajout d'un tag (ex: `v1.0.0`).

## Structure du projet

- `config/` : Configuration et constantes.
- `controllers/` : Logique de traitement des requêtes.
- `services/` : Appels aux API externes (TMDB).
- `middlewares/` : Gestion du CORS et du Logging.
- `tests/` : Tests unitaires PHPUnit.
- `bruno-collections/` : Fichiers de test pour Bruno.
- `index.php` : Point d'entrée et routeur de l'API.
