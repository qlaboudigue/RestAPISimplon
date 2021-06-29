# Sujet

Dans un dépôt Gitlab/Github dont tu nous donneras le lien :

- créer les entités correspondantes ;
- créer les composants d'accès aux données (Repository/DAO) pour ces entités ;
- rendre le CRUD accessible via une API REST ;
décrire dans un fichier tes choix, la méthodologie employée, les difficultés rencontrées, les ressources utilisées, le temps passé…

Aucune contrainte sur le langage, mais il est interdit d'utiliser un framework ou un ORM.

# Méthodologie

## Interprétation du sujet

Le sujet présente une structure de donnée semblable à celle d'un blog avec des utilisateurs (Users)  pouvant écrire des messages (Posts). Les relations entre les entités indiquent que chaque message possède un auteur et un sujet (Topic). Les sujets étant eux mêmes regroupés par catégorie (Category).

Le "design pattern" DAO (pour Data Access Object) permet de séparer les objets métiers et le code lié à la persistance de ces objets (dans une base de données par exemple). Via l'objet DAO, on doit pouvoir réaliser les 4 fonctions de base du stockage de données : CRUD (pour Create, Read, Update, Delete).

Un API (signifiant "Application Programming Interface") est un messager à l'écoute d'une requête client qui va indiquer au système/ à l'application quelle type de réponse envoyer. Par exemple :
https://openweathermap.org/api propose un api permettant à une application cliente de récupérer des données météréologiques. Configurer un API consiste à mettre en place des "End point", c'est-à-dire des cannaux de communication autorisés entre un client et notre serveur.

REST est un principe d'achitecture indiquant qu'une application doit favoriser le protocol HTTP (et notamment l'utilisation des verbes GET et POST)

L'exercice en trois temps consiste donc à :
- Créer les "class" correspondantes au schéma,
- Créer les "class" nécessaires à l'application du pattern DAO,
- Rendre les opération CRUD accessibles via un API Rest.

L'exercice se résume à écrire avec un langage "BackEnd" (CRUD accessible via un API Rest).

## Problèmes rencontrés

Mes projets réalisés jusqu'à maintenant concernaient principalement la conception du Front et par raccourci de langage, je nommais toujours ma "class" responsable des requêtes CRUD vers ma Base de données: "projetAPI". Cette habitude m'a énormément géné dans ma compréhension du sujet alors que j'avais pour habitude d'utiliser des framworks ou ORM qui géraient la partie Back-end de mes projets. Je confondais les requêtes envoyées à l'API par le Client et l'API lui même côté Back-end.

## Set-Up

### Choix du langage : PHP, Version 8.0.7. Installation via homebrew.
### Mise en place d'un server web local (127.0.0.1) : MAMP V6.3.
### Création de la base de données via PHPMyADMIN.
### Installation de POSTMAN permettant d'envoyer des requêtes client et de tester le futur API.
### Création des tables correspondantes à la structure de données indiquée.

## Go

### Création de la class "Database" permettant la connexion à la base de donnée.
### Création de la class User et des "Entry points" correspondants sans utiliser le DAO pattern.
### Tests avec POSTMAN et CRUD fonctionnel
### Mise en place du DAO pattern avec la création de UserDAO.php.


# Ressources

https://www.positronx.io
https://appbrewery.co
https://gist.github.com/thoriqmacto/cce63828612848c1919a
https://stackoverflow.com/questions/11266388/php-data-access-object
https://openclassrooms.com/fr/courses/6573181-adoptez-les-api-rest-pour-vos-projets-web/6816951-initiez-vous-au-fonctionnement-des-api
