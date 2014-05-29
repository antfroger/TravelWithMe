TravelWithMe
============

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/c175acc7-6c0e-4cb6-a0dc-699fd11ca92d/mini.png)](https://insight.sensiolabs.com/projects/c175acc7-6c0e-4cb6-a0dc-699fd11ca92d "SensioLabsInsight")

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

    // Dump the assets using assetic
    phing dump-asset

    // Test a bundle with Behat
    bin/behat -p=travel

---
Hooks
-----

The git pre-commit hook use SensioLabs' PHP Coding Standards Fixer.
To install this tool, please follow the instructions: http://cs.sensiolabs.org/

Then, please, install the provided hooks with these simple command:

    cd /path/to/project/root/directory;
    rm -rf .git/hooks/;
    ln -s ../.hooks .git/hooks;
