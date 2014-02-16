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

    // Synchronise the database using the Doctrine command
    phing sync-database

    // Load the fixtures
    phing load-fixtures

    // Generate an entity using Symfony2 command
    phing gen-entity -De=TWM/DemoBundle/Entity/Product

    // Run the unit tests
    phing check

    // Extract the translation keys of a bundle
    phing trans -Db=TWMDemoBundle -Dlg=fr
    phing trans-routes -Db=TWMDemoBundle -Dlg=fr

    // Clear cache
    phing clear-cache

    // Dump the assets using assetic
    phing dump-asset

    // Test a bundle with Behat
    bin/behat "@TWMSiteBundle"
    bin/behat -p=travel

---
Hooks
-----

Please, install the provided hooks with this simple command :

    ln -s ../.hooks .git/hooks
