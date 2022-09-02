<?php

use Slim\Slim;

require_once("vendor/autoload.php");

$app = new \Slim\Slim();

$app->config("debug", true);

$app->get("/", function () {
    echo "welcome to home page.";
});

$app->run();
