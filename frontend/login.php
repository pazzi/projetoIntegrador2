<?php
require 'config/config.php';
include("db.php");
error_reporting(0);
session_start();

if ($_POST['username'] && $_POST['passwd']) {
    $username = $_POST['username'];
    $client = new GuzzleHttp\Client();
    $local = "http://localhost:3001/usuarios/username/" . $username;
    $resposta = $client->request('GET', $local);
    $dados = json_decode($resposta->getBody());

    if (password_verify($_POST["passwd"], $dados[0]->senha_hash)) {
        $_SESSION["username"] = $dados[0]->username;
        $_SESSION["usuario_id"] = $dados[0]->id;
        $_SESSION["perfil"] = $dados[0]->perfil;
        header("Location:index.php");
    } else {
        $msg = "Login ou Senha inválidos";
    }
} else {
    $msg = "Entre com o usuário e senha";
}
$smarty->assign("msg", $msg);
$smarty->display("login.tpl");
