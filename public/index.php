<?php


require __DIR__ . '/../vendor/autoload.php';

use Core\Container;

$container = new Container();

$app = $container->singleton('app');

$app->run();