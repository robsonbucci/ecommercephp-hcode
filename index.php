<?php

use Slim\Slim;

require_once("vendor/autoload.php");

$app = new \Slim\Slim();

$app->config("debug", true);

$app->get("/", function () {
    $sql = new Hcode\DB\Sql();
    $result = $sql->select("SELECT * FROM tb_persons;");
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
});

$app->run();
