<?php

use Symfony\Component\ClassLoader\ApcClassLoader;
use Symfony\Component\HttpFoundation\Request;

// Use APC for autoloading to improve performance.
// Change 'sf2' to a unique prefix in order to prevent cache key conflicts
// with other applications also using APC.
/*
$loader = require_once __DIR__.'/../app/bootstrap.php.cache';

$loader = new ApcClassLoader('sf2', $loader);
$loader->register(true);
*/

require_once __DIR__.'/../app/AppKernel.php';
//require_once __DIR__.'/../app/AppCache.php';

// Gets the configuration from the openshift environment variables
$_SERVER['SYMFONY__DATABASE__HOST'] = getenv('OPENSHIFT_MYSQL_DB_HOST');
$_SERVER['SYMFONY__DATABASE__PORT'] = getenv('OPENSHIFT_MYSQL_DB_PORT');
$_SERVER['SYMFONY__DATABASE__USER'] = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
$_SERVER['SYMFONY__DATABASE__PASSWORD'] = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');

$kernel = new AppKernel('prod', false);
$kernel->loadClassCache();
//$kernel = new AppCache($kernel);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
