TravelWithMe
============

TravelWithMe is a community website.
Users can share their travels around the world, the good addresses, hostels, restaurants they found.
Users who prepare their journey can find good advices of people that already went to the same destination.
Users who are travelling can share their impressions with their family or friends thanks to a personal blog.

A [translation service] (http://travelwithme/app_dev.php/_trans/) is available.

---

Some usefull commands :

    php app/console translation:extract fr --bundle=AntfrogerTravelWithMeBundle
    php app/console cache:clear (à exécuter à chaque nouvelle variable de traduction)