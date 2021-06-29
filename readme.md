# Sujet

Dans un dépôt Gitlab/Github dont tu nous donneras le lien :

- créer les entités correspondantes ;
- créer les composants d'accès aux données (Repository/DAO) pour ces entités ;
- rendre le CRUD accessible via une API REST ;
décrire dans un fichier tes choix, la méthodologie employée, les difficultés rencontrées, les ressources utilisées, le temps passé…

Aucune contrainte sur le langage, mais il est interdit d'utiliser un framework ou un ORM.

# Méthodologie

## Interprétation du sujet

Le sujet présente une structure de données semblable à celle d'un blog avec des utilisateurs (Users)  pouvant écrire des messages (Posts). Les relations entre les entités indiquent que chaque message possède un auteur et un sujet (Topic). Les sujets étant eux mêmes regroupés par catégorie (Category).

Le "design pattern" DAO (pour Data Access Object) permet de séparer les objets métiers et le code lié à la persistance de ces objets (dans une base de données par exemple). Via l'objet DAO, on doit pouvoir réaliser les 4 fonctions de base du stockage de données : CRUD (pour Create, Read, Update, Delete).

Un API (signifiant "Application Programming Interface") est un messager à l'écoute d'une requête client qui va indiquer au système/ à l'application quelle réponse envoyer. Par exemple :
https://openweathermap.org/api propose un api permettant à une application cliente de récupérer des données météréologiques. Configurer un API consiste à mettre en place des "End point", c'est-à-dire des cannaux de communication autorisés entre un client et notre serveur.

REST est un principe d'achitecture indiquant qu'une application doit favoriser le protocol HTTP (et notamment l'utilisation des verbes GET et POST)

L'exercice en trois temps consiste donc à :
- Créer les "class" correspondantes au schéma.
- Créer les "class" nécessaires à l'application du pattern DAO.
- Rendre les opération CRUD accessibles via un API Rest.

Le tout dans un langage "Back-end".

## Problèmes rencontrés vis à vis du sujet

Dans mes précédents projets, j'ai souvent utilisé un framework ou ORM pour gérer la partie Back-end. Jusqu'à maintenant, un API était pour moi comme une boite noire et je m'en étais surtout servi pour récupérer des données (en Lecture) via une requête GET.

J'ai aussi pris l'habitude à tord, de nommer ma "class" regroupant toutes les requêtes CRUD "ProjetAPI". Cette habitude m'a énormément géné dans ma compréhension du sujet vu que je confondais les requêtes envoyées à l'API par le Client et l'API lui même côté Back-end.

## Set-Up

- Choix du langage : PHP, Version 8.0.7. Installation via homebrew.
- Mise en place d'un server web local (127.0.0.1) : MAMP V6.3.
- Création de la base de données via PHPMyADMIN.
- Installation de POSTMAN permettant d'envoyer des requêtes client et de tester le futur API.
- Création des tables correspondantes (au nombre de 4) à la structure de données indiquée. Exemple pour les "Users": 

    CREATE TABLE IF NOT EXISTS `User` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `email` varchar(256) NOT NULL,
      `password` varchar(50) NOT NULL,
      `birthDate` datetime NOT NULL,
      PRIMARY KEY (`id`)
    )ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

## Go

- Création de la class "Database" permettant la connexion à la base de données.
- Création de la class User et des "Entry points" correspondants sans utiliser le DAO pattern.
- Tests avec POSTMAN : CRUD fonctionnel.
- Mise en place du DAO pattern avec la création de UserDAO.php.
- Duplication du travail réalisé sur les autres entités.
- "Refactoring" du code.
- Mise de place de mesures de contrôles sur les Inputs (dans le cas de l'Update). 
- Création des methodes "SingleRead($itemId)" permettant via l'Id d'une entité de récupérer les informations détaillées. Par exemple récupérer l'identité de l'auteur d'un post via son Id.

# Arborescence des fichiers
    
    . config :
        - database.php
    . class :
        - user.php
        - userDao.php
        - topic.php
        - topicDao.php
        - post.php
        - postDao.php
        - category.php
        - categoryDao.php
    . api :
        - create User/Post/Topic/Category .php
        - read User/Post/Topic/Category .php
        - update User/Post/Topic/Category .php
        - delete User/Post/Topic/Category .php

# Interrogations / À creuser

- Pour chaque entité, la "class" objetDao est censée se reposer sur l'objet correspondant. Par exemple userDao.php est censée s'appuyer sur user.php : pour l'instant , la classe métier est très peu utilisée.
- Les "class" Dao possèdent des méthodes communes. Il faudrait créer une "class" basicDao avec ces méthodes pour que toutes les autres "class" puissent en hériter.

# Ressources

- https://www.positronx.io
- https://appbrewery.co
- https://gist.github.com/thoriqmacto/cce63828612848c1919a
- https://stackoverflow.com/questions/11266388/php-data-access-object
- https://openclassrooms.com/fr/courses/6573181-adoptez-les-api-rest-pour-vos-projets-web/6816951-initiez-vous-au-fonctionnement-des-api

# To do (bonus)

- Créer un blog fonctionnel basé sur cette structure de données (présence de la page index.php)
    . Formulaire de connexion OK
    . Formulaire d'inscription OK
    . Timeout.
