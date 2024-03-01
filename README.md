# demo-docker-deploiement

Sources d'un projet fictif web minimal à déployer en prod.

## Pré-requis

- Installer [Docker (Docker Engine)](https://www.docker.com/get-started/) sur la machine hôte;

## Lancer le projet

1. Cloner le dépôt;
2. Créer le dossier `db-data` à la racine du projet (volume du service `db`)
3. Créer le dossier `db` pour stocker les secrets du service `db`. Y créer les fichiers suivants :
   1. `dbname`
   2. `password`
   3. `rootpassword`
   4. `user`
4. Instancier les services:

À la racine du projet :
~~~bash
docker compose up --build
~~~

<!-- 
créer les secrets
 -->

## Développement

Lancer le watch des sources (*hot reload*) :

~~~bash
docker compose watch
~~~

### Configuration de MySQL - Variables d'environnement

> Be aware that the environment variables for MySQL are only used if no database exists when the container starts (no database in the volume). To change credentials, remove the volume and then restart.

## Arrêter le projet

A la racine du projet :
~~~bash
docker compose down
~~~
