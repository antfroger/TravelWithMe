TravelWithMe
============

TravelWithMe is a community website.
Users can share their travels around the world, the good addresses, hostels, restaurants they found.
Users who prepare their journey can find good advices of people that already went to the same destination.
Users who are travelling can share their impressions with their family or friends thanks to a personal blog.

A [translation service] (http://travelwithme/app_dev.php/_trans/) is available.

---

Some usefull commands :

    php app/console translation:extract fr --bundle=AntfrogerTravelWithMeBundle (extrait toutes les variables de trad utilisées sur l'application et les enregistre dans des fichiers)
    php app/console cache:clear
    php app/console assetic:dump --env=prod --no-debug (génère et enregistre chaque asset utilisé - à exécuter à chaque MEP)
    php app/console doctrine:generate:entities Acme/StoreBundle/Entity/Product (génère les getters/setters d'une Entity)
    php app/console doctrine:schema:update --force (met à jour la bdd à partir des entités)