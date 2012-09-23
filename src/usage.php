<?php

error_reporting(-1);
ini_set("display_errors", 1);

require_once('splClassLoader.php');
$classLoader = new SplClassLoader('CentralApps\Mail', __DIR__ . '/' );
$classLoader->register();
$classLoader = new SplClassLoader('CentralApps\PostMarkApp', __DIR__ . '/' );
$classLoader->register();

$configuration = new \CentralApps\PostMarkApp\Configuration();
$message = new \CentralApps\PostMarkApp\Message();
$transport = new \CentralApps\PostMarkApp\Transport( $configuration );

$dispatcher = new \CentralApps\Mail\Dispatcher();

