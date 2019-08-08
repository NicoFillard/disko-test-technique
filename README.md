# DISKO TEST TECHNIQUE

Réalisation d'un mini-site versionné en Symfony.

# Installation 

Cloner le projet : git clone https://github.com/NicoFillard/disko-test-technique.git

Installer Composer si ce n'est pas encore fait. 
Puis lancer la commande :  **composer install**

A la racine du projet créer un fichier **.env.local** (ce fichier override le fichier .env qui est envoyé sur Git)
Reprendre le code du fichier .env et modifier la ligne :
**DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name**
en y mettant ses paramètres de connexion à la base de données.

Créer la base de données avec la commande : **php bin/console doctrine:database:create**

Mettre à jour le schéma de base de données : **php bin/console doctrine:schema:update --force**

Pour lancer le webserver de dev : **php bin/console server:run**

## Fixtures

Exécuter les fixtures pour ajouter des datas à la base de données : **php bin/console doctrine:fixtures:load**

## Connexion à l'admin

Email : fillard.nico@hotmail.fr
Password : diskoTest
