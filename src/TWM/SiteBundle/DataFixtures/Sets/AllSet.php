<?php

use h4cc\AliceFixturesBundle\Fixtures\FixtureSet;

// Creating a fixture set with own configuration
$set = new FixtureSet(array(
    'do_drop' => true,
    'do_persist' => true,
));

$set->addFile(__DIR__ . '/../Fixtures/User.yml', 'yaml');
$set->addFile(__DIR__ . '/../Fixtures/Travel.yml', 'yaml');

return $set;
