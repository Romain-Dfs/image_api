# API de FileManagement pour le réseau social ShareMoumouth

Ce depôt git contient une API de FileManagement pour le réseau social ShareMoumouth
Le projet utilise le Framework Symfony, le CDN Cloudinary, et est build en Clean Architecture.
Vous trouverez ci-dessous les étapes nécessaire à l'installation et l'utilisation de ce dépot

### Liste des commandes

Se placer au niveau du Makefile

- Installer les dépendances : `make install`
- Installer la db : `make build` puis taper `yes`
- Lancer l'environnement de dev : `make dev`
- Stopper l'environnement de dev : `make stop`

### L'environnement de développement 

- `localhost:8000` : Contient l'environnement Symfony
- `localhost:8080` : Permet d'accéder à l'outil de gestion de DB

### Le stockage des images

Les images sont stockées sur Cloudflare, et pour vous simplifier la correction si vous souhaitez tester, j'ai laissé mes clés d'API (c'est pas bien, mais j'ai créé un nouveau compte exprès). 
Je n'ai pas utilisé PostgreSQL (pour le moment) car j'ai un soucis avec mon environnement Docker qui m'empêche de l'installer correctement pour le moment, mais ça sera patch
