<?php
error_reporting(0);
require 'config/config.php';
session_start();
$login = $_SESSION['username'];

$msg = "Arquivos disponíveis";
$client = new GuzzleHttp\Client();

$resposta = $client->request('GET', 'http://localhost:3001/arquivos');
$dados = json_decode($resposta->getBody());

$smarty->assign("titulo", $msg);
$smarty->assign("dados", $dados);
$smarty->assign("login", $login);
$smarty->display("index.tpl");
