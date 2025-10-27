<?php
require 'config/config.php';
include 'db.php';


if (isset($_POST['submit'])) {

    try {
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $dbh->prepare("insert into usuarios (username, email, senha_hash, nome_completo, perfil, ativo, created_at, updated_at) values (?,?,?,?,?,?,?,?)");
        $stmt->bindParam(1, $_POST['username']);
        $stmt->bindParam(2, $_POST['email']);
        $stmt->bindParam(3, password_hash($_POST['senha_hash'], PASSWORD_DEFAULT));
        $stmt->bindParam(4, $_POST['nome_completo']);
        $stmt->bindParam(5, $_POST['perfil']);
        $stmt->bindParam(6, $_POST['ativo']);
        $stmt->bindParam(7, date('Y-m-d H:i:s'));
        $stmt->bindParam(8, date('Y-m-d H:i:s'));

        if ($stmt->execute())
            header("location:inicio_adm.php");
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "Erro no acesso ao BD";
        die();
    }
}


//$smarty->display('inicio_adm.tpl');
