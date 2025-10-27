<?php
error_reporting(0);
session_start();
require 'config/config.php';
include("db.php");


try {
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sth = $dbh->prepare('SELECT * FROM arquivos ORDER BY nome_armazenamento');
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "Erro ao acessar o BD";
    die();
}


$smarty->assign('dados', $result);
//$smarty->assign('page',$_SERVER['PHP_SELF']);
$smarty->display('inicio_adm.tpl');
