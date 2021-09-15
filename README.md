# Squelette de Wiseband 3.0

Ce depôt git contient une application Symfony de base avec un environnement docker. 
Vous trouverez ci-dessous les étapes nécessaire à l'installation et l'utilisation de ce dépot

### Récupérer le dépôt et l'utiliser 

Pour récupérer le dépot, faites :<br> 
`git clone https://votre_token_github@github.com/hpmousse/WBsquelette.git`<br>
**N'oubliez pas de bien indiquez votre token**

### Créer vote branche git 

Pour réaliser vos modifications, vous pouvez créer votre branche afin de ne pas modifier la branche principale **main**.<br>
Pour modifier la branche **main**, vous pouvez réaliser une PR afin de valider les modifications.

### Installer les dépendances 

Quand vous récupérez le dépôt, il est important d'initialiser les dépendances. Rendez vous dans **/WBsquelette** et réaliser un `make install` qui va installer toutes les dépendances nécessaires au bon fonctionnement de l'instance Symfony.

### Lancer et stopper l'instance Symfony

**Une fois les dépendances installées**, vous pouvez lancer votre application Symfony avec la commande `make dev` qui vient lancer l'environnement de développement.

Pour arrêter l'instance Symfony, lancez la commande `make stop` qui vient arrêter totalement l'application.

### L'environnement de développement 

- `localhost:8000` : Contient l'environnement Symfony
- `localhost:8080` : Permet d'accéder à l'outil de gestion de DB

### Utiliser Composer et Symfony

Pour éviter tous les problèmes d'environnement, vous n'êtes pas obligé d'installer Composer et Symfony sur votre environnement, ils sont présent dans le docker.

Pour les utiliser, il est donc nécessaire de passer par les conteneurs et pour simplifier la tâche, un fichier **aliases.sh** permet de lancer facilement ces commandes. 

Ce fichier vient installer des aliases sur votre machine seulement dans l'instance shell actuelle. Pour l'exécuter, lancez la commande `. ./aliases.sh`. 
Pour ne pas lancer cette commande à chaque fois, vous pouvez sinon ajouter ces aliases directement sur votre machine.

### Les commandes Composer et Symfony

Une fois les alias ajoutés, vous avez accès aux commandes suivantes : 

- `sy` : Cette commande équivaut au `php bin/console` très souvent utilisée dans Symfony
- `comp` : Cette commande est tout simplement la commande `composer`
- `compreq` : Cette commande correspond à la commande `composer require`

