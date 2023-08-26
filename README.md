
# JOB BOARD

Création d'une page de Job Board, permettant la consultation d'offres d'emploi avec des fonctionnalités de filtrage et de pagination avec la base de données MySQL et le langage de programmation PHP. 

## Prérequis

- PHP >= 8.1
- MySQL
- Composer 

## Installation

Cloné le projet avec la commande

```bash
https://github.com/matthCorvo/Job-Board-PHP.git
```
Ensuite, dans l'ordre taper les commandes dans votre terminal :

```bash
  composer install
  composer update
```
## Structure du Projet

```bash

job-board/
|-- app/
| |-- config/
| | |-- Database.php
| |
| |-- lib/
| | |-- Utility.php
| |
| |-- Controller / // A AJOUTER
| | |-- Utility.php
| |
| |-- models/
| | |-- JobModel.php
| | |-- ApiModel.php // MODIFIER NOM
| | |-- PaginationModel.php // MODIFIER NOM
| |
|-- views/
| |-- include/
| | |-- header.php
| | |-- footer.php
| |
| |-- job/
| | |-- index.php
| | |-- filtre.php
| | |-- liste.php
| | |-- pagination.php
| |-- index.php
| |
|-- assets/
| |-- css/
| |   |-- filtre/
| |   |-- liste/
| |   |-- main/
| |   
| |-- js/
| |   |-- page/ // A AJOUTER FILTRE 
|
|-- index.php
```
## Base de Données

Le projet utilise une base de données MySQL avec les tables suivantes :

### Table des entreprises

```sql

TABLE `villes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
)

TABLE `metiers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
)

TABLE `contrats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
)

TABLE `offres_emploi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_publication` date NOT NULL,
  `date_mise_a_jour` date DEFAULT NULL,
  `reference` varchar(255) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `entreprise` varchar(100) NOT NULL,
  `ville_id` int(11) NOT NULL,
  `contrat_id` int(11) NOT NULL,
  `metier_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ville_id` (`ville_id`),
  KEY `fk_contrat_id` (`contrat_id`),
  KEY `fk_metier_id` (`metier_id`)
  )
## Fonctionnalités

- Affichage des offres d'emploi avec les détails suivants :
Date de publication au format français (ex: Vendredi 18 août 2023)
Référence unique de l'offre d'emploi
Intitulé de l'offre
Lieu (ville)
Type de contrat
Type de métier
Nom de l'entreprise
Description de l'offre (30 premiers caractères)
Affichage d'une image liée à chaque offre en utilisant l'API gratuite some-random-api.ml qui retourne un format JSON.
Filtres cumulables en utilisant des paramètres GET (ex: ?metier=XXX&contrat=XXX) avec possibilité de réinitialiser les filtres.
Pagination avec 10 offres par page.
Tri de la liste par date de publication ascendante/descendante et ordre alphabétique ascendante/descendante.
