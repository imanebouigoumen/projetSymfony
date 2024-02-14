ELASRY HAITAM

BOUIGOUMEN IMANE

SAIDI NOOR LYLIA

BAHHOUS HOUSSAMEDDINE

QUESTION 1:

docker-compose build

docker-compose up -d

docker ps

docker exec -ti my-good-container bash

dans le conteneur : 

symfony new monprojet --webapp

cd monprojet

symfony server:start --no-tls --d

pour mettre en place webpack encore et bootstrap:

symfony composer require symfony/webpack-encore-bundle

npm install

npm install bootstrap

QUESTION 2:

symfony console make:entity lecon (insertion des champs 'nom' et 'description')

symfony console make:migration

symfony console doctrine:migrations:migrate

QUESTION 3:

symfony composer require fakerphp/faker

on a installé le package fixture:

symfony composer require orm-fixtures --dev

symfony console make:fixture

on a modifié le fichier 'LeconFixtures.php' pour générer des données fictives dans la fixture.

et on a lancé la commande:

symfony console doctrine:fixtures:load



