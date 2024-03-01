# demo-docker-deploiement

Sources d'un projet fictif à déployer en prod.

## Pré-requis

- Installer le Docker Engine sur la machine hôte;

## Lancer le projet

1. Clôner le dépôt;
2. 
3. Instancier les services:

A la racine du projet :
~~~bash
docker compose up
~~~

## Arrêter le projet

A la racine du projet :
~~~bash
docker compose down
~~~


## Notes

> Be aware that the environment variables for MySQL are only used if no database exists when the container starts (no database in the volume). To change credentials, remove the volume and then restart.