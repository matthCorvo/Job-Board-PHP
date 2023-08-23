# php Job Board
 Job Board PHP MySQL

 # php my sql
 utilisateur : SUBSKILL
 mdp : SUBSKILL

Le but de l’exercice est de créer une page de Job Board (offres d’emplois) avec un
minimum de filtres et une pagination.
Pour vous aider dans l’affichage, vous trouverez en annexe un mini « zoning » (un peu
plus bas dans le document).✔️
Le plus simple - le front n’étant pas noté ici - est de vous aider d’un framework type
Bootstrap (https://getbootstrap.com/) ou Materialize (https://materializecss.com/).✔️
L’intégralité de l’exercice sera basé sur PHP-MySQL.✔️
En terme d’affichage il vous faudra lister les offres d’emplois avec pour chacune des
offres :

● Date à laquelle l’offre a été publiée - L’affichage de la date doit être de la forme
française (Ex: Vendredi 18 août 2023)
● Date de mise à jour de l’offre (non affichée, mais présente en base)
● Référence unique de l’offre d’emploi
● Intitulé de l’offre
● Lieu (ville, on ne reste que sur la France)
● Type de contrat
● Type de métier
● Nom de l’entreprise qui poste l’annonce
● Description de l’offre (affichage des 30 premiers caractères seulement)

⚠️Une image devra être affichée dans l’encart dédié à une offre. Pour cela, il vous
faudra utiliser l’API (gratuite) suivante : https://some-random-api.ml/meme. L’api
retourne un format JSON. À vous d’utiliser ce JSON pour afficher l’image.
Relations :
Une entreprise peut avoir une ou plusieurs offres.
Une annonce ne peut avoir qu’un seul lieu (ville), mais une ville peut recenser plusieurs
annonces.
Une annonce ne peut avoir qu’un seul type de métier / contrat mais un métier (ou type de
contrat) peut être présent dans X annonces.
Les données devront être présentes directement en base, nous ne demandons pas
(obligatoirement) la création d’un back-office ici.
La liste devra comporter une pagination. Chaque page sera composée de 10 offres.
Selon le nombre d’offres présentes en base de données, votre pagination évoluera.
Ex: Si vous avez 15 offres, vous aurez 2 pages. Après filtrage sur une ville, si vous n’avez que 5
résultats, vous n’aurez donc plus de pagination.
La pagination devra se faire de la manière suivante (en $_GET) :
● Si vous avez 25 entrées en base, il y a donc 3 pages.
Il est préférable (mais non obligatoire) d’utiliser la ré-écriture d’URL de type :
● Au clic sur la page 2, l’URL doit devenir « /page2 »
● Au clic sur la page 3, l’URL doit devenir « /page3 »
Sinon, vous pouvez utiliser du $_GET simple de type « ?page=2 »
⚠️N’oubliez pas que si l’on utilise les filtres, ceux-ci doivent être gardés lors d’un
changement de page.
Ex: J’ai 45 entrées en base de données, j’ai donc 5 pages de base. J’ai utilisé le filtre « Types de
contrat : CDI », je n’ai plus que trois pages. Lorsque je vais cliquer sur la page 2, je dois
garder les filtres.
Le filtrage devra également se faire en $_GET (et donc vous aurez une URL de la forme «
?metier=XXX » ou « ?metier=XXX&contrat=XXX ». Les filtres sont cumulables.
Optionnel :
● Un bouton “reset” sur le formulaire pour réinitialiser l’ensemble des filtres et
pagination.
● Création d’une API avec trois routes pour ajouter une offre, modifier une offre,
supprimer une offre (sans protection / login)
Ajouter un tri sur la liste avec :
● Ordonner par date de publication ascendant / descendant
● Ordonner par ordre alphabétique ascendant / descendant

<!-- TO DO -->
● utiliser normalize et autre css - 

# création de la base de donnée 
CREATE TABLE IF NOT EXISTS `job_listings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_reference` varchar(255) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `job_location` varchar(255) NOT NULL,
  `job_contract` varchar(50) NOT NULL,
  `job_category` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date_posted` date NOT NULL,
  `date_updated` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `job_reference` (`job_reference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# structure du projet 
job-board/
|-- app/
|   |-- config/
|   |   |-- Database.php
|   |
|   |-- lib/
|   |   |-- debug.php
|   |
|   |-- models/
|   |   |-- JobModel.php
|   |
|   |-- views/
|       |-- include/
|       |   |-- header.php
|       |   |-- footer.php
|       |
|       |-- index.php
|       |
|       |-- job/
|           |-- index.php
|           |-- filtre.php
|           |-- detail.php
|
|-- assets/
|   |-- css/
|   |-- js/
|   |-- images/
|
|-- vendor/                  // Répertoire généré par Composer
|
|-- .htaccess
|-- composer.json
|-- composer.lock
|-- index.php


# mise en place de la base de donnée 
|-- config/
|   |   |-- Database.php
|   |

  - création des test 