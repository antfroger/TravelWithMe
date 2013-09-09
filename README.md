TravelWithMe
============

TravelWithMe is a community website.
Users can share their travels around the world, the good addresses, hostels, restaurants they found.
Users who prepare their journey can find good advices of people that already went to the same destination.
Users who are travelling can share their impressions with their family or friends thanks to a personal blog.

A [translation service] (http://travelwithme/app_dev.php/_trans/) is available.

---

Some usefull commands :

    phing sync-database
    phing load-fixtures
    phing gen-entity -De=TWM/DemoBundle/Entity/Product
    phing check
    phing translate -Db=TWMDemoBundle
    phing clear-cache
    phing dump-asset

---

Hooks

Install hooks in the .git/hooks/ by a simple command

    ln -s ../.hooks/ .git/hooks
