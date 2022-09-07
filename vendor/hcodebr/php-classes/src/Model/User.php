<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class User extends Model
{
    const SESSION = "User";

    public static function login($login, $password)
    {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(
            ":LOGIN" => $login
        ));

        if (count($results) === 0) throw new \Exception("Dados de usuário ou senha inválidos");

        $data = $results[0];

        // verificando senha
        if (password_verify($password, $data["despassword"])) {
            $user = new User();

            $user->setData($data);

            // criando sessão
            $_SESSION[User::SESSION] = $user->getValues();
            // criando sessão - fim
            return $user;
            
        } else throw new \Exception("Dados do usuário ou senha inválidos");
    }

    // verifica se pessoa está logada
    public static function verifyLogin($inadmin = true)
    {
        if (
            !isset($_SESSION[User::SESSION]) ||
            !$_SESSION[User::SESSION] ||
            !(int)$_SESSION[User::SESSION]["iduser"] > 0 ||
            (bool)$_SESSION[User::SESSION]["inadmin"] !== $inadmin
        ) {
            header("location: /admin/login");
        }
    }

    public static function logout()
    {
        $_SESSION[User::SESSION] = NULL;
    }
}
