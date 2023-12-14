# Projet Manzer

## Introduction
Manzer est un backend basé sur Laravel pour une application frontale écrite en ReactJS. Il offre une plateforme permettant aux utilisateurs de s'inscrire, se connecter, gérer et télécharger leurs repas. Un exemple de repas est le "Burger Végétarien - 3Brasseurs", comprenant une galette de pomme de terre, du Cheddar et du pain maison, situé à Ste Marie avec le numéro de contact 0262121314. Le projet est en ligne à [Manzer](https://manzer.formaterz.fr/).

## Configuration Système Requise
- PHP ^8.1
- Serveur web compatible avec Laravel (par exemple Apache, Nginx)
- Base de données SQL (par exemple MySQL, PostgreSQL)
- Composer pour la gestion des dépendances

## Installation
1. Clonez le dépôt Git du projet.
2. Exécutez `composer install` pour installer les dépendances PHP.
3. Configurez votre environnement de base de données dans le fichier `.env`.
4. Lancez les migrations avec `php artisan migrate` pour créer les structures de base de données.

## Utilisation
Le projet Manzer fournit les fonctionnalités suivantes :

### Authentification et Gestion des Utilisateurs
- Inscription (`POST /register`)
- Connexion (`POST /login`)
- Profil utilisateur (`GET /users/me` et `PUT /users/me`)
- Modification du mot de passe (`PUT /users/me/password`)
- Déconnexion (`POST /logout`)

### Gestion des Repas
- Listing des repas (`GET /meals`)
- Détails d'un repas spécifique (`GET /meals/{meal}`)
- Ajout de nouveaux repas (`POST /meals`)
- Mise à jour et suppression des repas (`POST /meals/{meal}`, `POST /meals/{meal}/status`, `DELETE /meals/{meal}`)

### Autres Fonctionnalités
- Réinitialisation du mot de passe (`POST /forgot-password`, `POST /reset-password`)
- Liste des secteurs (`GET /sectors`)

## Dépendances
- `laravel/framework`: ^10.10
- `laravel/sanctum`: ^3.3
- Autres dépendances listées dans `composer.json`

## Contribution
Les contributions au projet sont les bienvenues. Veuillez suivre les bonnes pratiques de développement Laravel et soumettre des pull requests pour toute modification ou amélioration.

## Licence
Ce projet Manzer est la propriété exclusive de son auteur et ne peut être réutilisé, copié, modifié ou distribué sans une autorisation explicite préalable. Pour toute demande de réutilisation ou d'obtention de licence, veuillez contacter le propriétaire du projet. Tous les droits sont réservés.
## Contact
Pour toute question ou soutien, veuillez contacter l'équipe de développement à [Manzer Contact](mailto:formation.etienne.re@gmail.com).
