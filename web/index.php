<?php

ini_set('display_errors', 0);

$loader = require_once __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../src/app.php';
require __DIR__.'/../config/prod.php';

$loader->add('App', __DIR__ . '/src');

$app->run();
