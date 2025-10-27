<?php
error_reporting(0);
require 'config/config.php';
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$login = $_SESSION['username'];

$msg = "Gestão de Usuários";
$client = new GuzzleHttp\Client();

$resposta = $client->request('GET', 'http://localhost:3001/arquivos');
$dados = json_decode($resposta->getBody());

$smarty->assign("login", $login);
$smarty->assign("titulo", $msg);
$smarty->assign("dados", $dados);
$smarty->display("adm_arquivo.tpl");
