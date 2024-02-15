ELASRY HAITAM

BOUIGOUMEN IMANE

SAIDI NOOR LYLIA

BAHHOUS HOUSSAMEDDINE

### QUESTION 1:

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

### QUESTION 2:

symfony console make:entity lecon (insertion des champs 'nom' et 'description')

symfony console make:migration

symfony console doctrine:migrations:migrate

### QUESTION 3:

symfony composer require fakerphp/faker

on a installé le package fixture:

symfony composer require orm-fixtures --dev

symfony console make:fixture

on a modifié le fichier 'LeconFixtures.php' pour générer des données fictives dans la fixture.

et on a lancé la commande:

symfony console doctrine:fixtures:load

### QUESTION 4:

symfony console make:crud lecon

modification des templates/lecon pour inclure bootstrap et du styling.

### QUESTION 5:

ajout d'une barre de navigation à 'base.html.twig'


### QUESTION 6:

symfony composer require cebe/markdown

on a ajouté au fichier 'services.yaml' : cebe\markdown\Markdown: ~

et on a modifié le code de la fonction index du fichier LeconController.php

### QUESTION 7: (petite modif)

pour créer l'entity user :

symfony console make:user 

symfony console make:entity User (on a ajouté les champs nom et prénom) 

modification du fichier 'User.php' pour ajouter le role 'professeur' par défaut.

symfony console m:mig

symfony console doctrine:migrations:migrate

(modif : symfony console make:auth et on a modifié la fonction onAthenticationSuccess, 

symfony console make:migrations 

symfony console doctrine:migrations:migrate

) 

### QUESTION 8:

création de la relation "ManyToOne" avec la commande : 

symfony console make:entity Lecon (on ajoute la relation avec l'entité User) et ensuite on fait les migrations : 

symfony console make:migration

symfony console doctrine:migrations:migrate


