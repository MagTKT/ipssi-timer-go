Timer Go
-----------------------------------------------------------------------------------------------------------------------

Ceci est un projet de décompte du temps pour developpeur travaillant en équipes sur des projets commun , il permet de suivre son temps de coding ainsi que de commenter se qui a été fait.

Vous pouvez trouver des instructions détaillées sur les fonctionnalités dans le guide de l'utilisateur de Timer Go: 
Documentation.md

Ce projet est actuellement maintenu.

Clonage du projet Timer Go
--------------------------

Ce qui suit vous donnera un projet qui est configuré et prêt à être utilisé:

git clone git@github.com:MagTKT/ipssi-timer-go.git
<br>
Dans votre terminal effectuer la commande :
<br>
cd ipssi-timer-go
<br>
Avant toute commande supplementaire assuré vous de creer un fichier a la racine du projet nommé .env
copier coller l'intégralité de .envExemple.
<br>
Il vous faudra modifier uniquement la parti base de donnée en y indiquant un nom de bdd un user et un mot de passe.
<br>
EXEMPLE:
<br>
MYSQL_DATABASE='nom de votre base'
MYSQL_USER='user de la base'
MYSQL_PASSWORD='mot de passe de la base'
<br>
puis de nouveau dans votre terminal:
<br>
docker-compose up --build

Effectuer les migrations:
-------------------------

Toujours dans votre terminal:
<br>
docker-compose exec web php bin/console make:migration
<br>
docker-compose exec web php bin/console doctrine:migration:migrate
<br>
Puis naviguer vers localhost:8010


Parametrage specifique (en cas de soucis):
------------------------------------------

Sous windows : le docker-compose doit etre en version: '3.6'
<br>
Sous mac : le docker-compose doit etre en version: '3.7'



