TravelWithMe
============

Un [système de traduction] (http://travelwithme/app_dev.php/_trans/) des différentes variables utilisées sur toutes l'application est disponible.

---

Quelques commandes pratiques :

    php app/console translation:extract fr --bundle=AntfrogerTravelWithMeBundle
    php app/console cache:clear (à exécuter à chaque nouvelle variable de traduction)
