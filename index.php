<?php

use Slim\Slim;
use Hcode\Page;

require_once("vendor/autoload.php");

$app = new Slim();

$app->config("debug", true);

$app->get("/", function () {
    // * tem que instanciar Page
    $page = new Page();

    // * vai chamar construct e criar pagina;
    $page->setTpl("index");    // * apos terminar o carregamnento, classe vai chamar destruct que fechará com footer.html;
});

// * Executa toda instrução 
$app->run();
