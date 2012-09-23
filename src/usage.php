<?php

error_reporting(-1);
ini_set("display_errors", 1);

require_once('splClassLoader.php');
$classLoader = new SplClassLoader('CentralApps\Mail', __DIR__ . '/' );
$classLoader->register();
$classLoader = new SplClassLoader('CentralApps\PostMarkApp', __DIR__ . '/' );
$classLoader->register();

$sender = new \CentralApps\Mail\SendersReceiversEtc\Sender("mkpeacock@gmail.com", "Michael Peacock");

$configuration = new \CentralApps\PostMarkApp\Configuration();
$message = new \CentralApps\PostMarkApp\Message();
$transport = new \CentralApps\PostMarkApp\Transport( $configuration );

$dispatcher = new \CentralApps\Mail\Dispatcher();

$message->setSender($sender);
$message->setPlainTextMessage("Hi there");

$recipient = new \CentralApps\Mail\SendersReceiversEtc\Recipient("mkpeacock@gmail.com", "Michael Peacock");
$message->addRecipient($recipient);


