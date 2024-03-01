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
4. Créer le fichier `.env` à partir de `.env.dist` : `cp .env.dist .env`
5. Instancier les services:

À la racine du projet :
~~~bash
docker compose up --build -d
#Vérifier que les deux services sont bien lancés
docker compose ps
~~~

<!-- 
créer les secrets
 -->

## Développement

Lancer le watch des sources (*hot reload*) :

~~~bash
docker compose watch
~~~

### Initialisation du service MySQL - Variables d'environnement et scripts

[Extrait de la doc](https://hub.docker.com/_/mysql): *Do note that **none of the variables below will have any effect if you start the container with a data directory that already contains a database**: any pre-existing database will always be left untouched on container startup.*

Donc, les variables d'environnement pour MySQL sont utilisées uniquement lorsqu'aucune base de données (volume contenant le système de fichiers de MySQL) n'est associée à l'instanciation du service. Pour modifier les credentials, il faut vider le volume avant, **puis**, redémarrer. Sinon le faire directement en SQL. **Idem** pour les scripts contenus dans le dossier [`docker-entrypoint-initdb.d`](./docker-entrypoint-initdb.d/).

### Vérifier que la base de données est bien initialisée

Ouvrir un shell interactif avec le service `db`:

~~~bash
docker compose exec -it server /bin/bash
~~~

Dans le shell, se connecter puis :

~~~SQL
-- mydb doit être présente
SHOW DATABASES;
-- l'utilisateur myuser doit être listé
SELECT host, user FROM mysql.user;
~~~

> Pour vérifier que l'initialisation de la base from scratch a fonctionné, 

## Arrêter le projet

A la racine du projet :
~~~bash
docker compose down
~~~
