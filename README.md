TravelWithMe
============

TravelWithMe is a community website.

Users can share their travels around the world, the good addresses, hostels, restaurants they found.
Users who prepare their journey can find good advice of people that already went to the same destination.
Users who are traveling can share their impressions with their family or friends thanks to a personal blog.

A [translation service] (http://travelwithme/app_dev.php/_trans/) is available.

---

Commands
--------

Some useful commands :

    phing sync-database // Synchronise the database using the Doctrine command
    phing load-fixtures // Load the fixtures
    phing gen-entity -De=TWM/DemoBundle/Entity/Product // Generate an entity using Symfony2 command
    phing check         // Run the unit tests
    phing translate -Db=TWMDemoBundle // Extract the translation keys of a bundle
    phing clear-cache   // Clear cache
    phing dump-asset    // Dump the assets using assetic

---

Hooks
-----

Please, install the provided hooks with this simple command :

    ln -s ../.hooks .git/hooks
