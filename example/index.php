<?php
require_once "...../composer-package/vendor/autoload.php";

$factory = new \SharpMinds\Storage\Factory();
//$factory->setCustomConfig($path);
$factory->setConnectionParameters([
	"scheme" => "tcp",
	"host" => "127.0.0.1",
	"port" => 6379
]);
$storage = $factory->create();


$d = new \DateTime('2011-01-01 15:03:01');

$storage->set("hello_world", $d);
$value = $storage->get("hello_world");
var_dump($value);

$value = $storage->get("some_key_3");
var_dump($value);