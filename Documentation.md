Documentation technique
--------------------------------
Timer Go est basé sur un ensemble de composants Open Source. Nous indiquons ci-dessous les principales briques composant cette plate-forme.
<br><br>
- Symfony5
- mysql
<br><br>
Architecture technique
--------------------------------
Un docker-compose a été mis en place contenant :
<br><br>
.docker/php
node:12-alpine
composer:1.9.0
phpmyadmin/phpmyadmin
<br><br>
<br><br>
Stockage des données:
--------------------------------
L’ensemble des données hors fichiers joints sont stockées dans dans un modèle relationnel explicite et hiérarchisé dans une base de données PostgreSQL.
<br><br>
Les fichiers joints (multimédias, logos …) sont libre de droit  et stockés dans un dossier public asset.
<br><br>
Base de données:
--------------------------------
mysql:8.0.17
<br><br>
<br><br>
--------------------------------
Fonctionnalités index :
--------------------------------
Page d'accueil -> gère uniquement l'acces à la page d'acceuil-> HomeController -> templates/base.html
<br><br>
Page Contact -> gère la page de contact -> ContactController -> form/ContactType -> templates/contact/contact.html.twig
Pour l'envoi d'email -> templates/emails/contact.html.twig
<br><br>
Projet -> gère la création, l'édition, la suppression d'un projet et attribut un projet a une team et à tout les membres de cette équipes -> ProjectController -> entity/Project-> templates/project/index.html.twig
<br><br>
Team -> gère la création, l'édition, la suppression d'une Team -> Entity/Team -> Controller/TeamController -> templates/Team/index.html.twig
<br><br>
User -> gère la création, l'édition, la suppression  d'un user -> Entity/User -> UserController -> templates/user/index.html
<br><br>
UserTeam -> gère la création, l'édition, la suppression  d'un utilisateur dans une équipe(attribut automatiquement tout les project de l'equipe au nouvel utilisateur )-> UserTeamController -> templates/UserTeam/index.html.twig
<br><br>
UserProject -> gère la création, l'édition, la suppression d'un projet sans user et team lié -> UserProjectController -> templates/UserProject/index.html.twig
<br><br>
Timer -> gère la création, l'édition, la suppression d'un temps enregistrer sur un projet défini avec un user connecter -> Entity/Timer -> TimerController -> template/timer/index.html.twig



