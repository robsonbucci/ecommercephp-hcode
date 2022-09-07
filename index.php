<?php
session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;


$app = new Slim();

$app->config("debug", true);

$app->get("/", function () {
    // * tem que instanciar Page
    $page = new Page();

    // * vai chamar construct e criar pagina;
    $page->setTpl("index");    // * apos terminar o carregamnento, classe vai chamar destruct que fechará com footer.html;
});


$app->get("/admin", function () {
    // verificando se esta logado
    User::verifyLogin();
    // verificando se esta logado - fim
    $page = new PageAdmin();

    // * vai chamar construct e criar pagina;
    $page->setTpl("index");    // * apos terminar o carregamnento, classe vai chamar destruct que fechará com footer.html;
});

$app->get("/admin/login", function () {
    $page = new PageAdmin([
        "header" => false,
        "footer" => false
    ]);

    $page->setTpl("login");
});

$app->post("/admin/login", function () {
    User::login($_POST["login"], $_POST["password"]);

    header("location: /admin");
    exit;
});

$app->get('admin/logout', function(){
    User::logout();
    header("location: /admin/login");
});

// * Executa toda instrução 
$app->run();
