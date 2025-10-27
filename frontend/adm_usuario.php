<?php
error_reporting(0);
require 'config/config.php';
include('db.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$login = $_SESSION['username'];
$msg = "Gestão de Usuários";

if ($_GET['oper'] == "del") {
    $usuario_id = $_GET['valor'];
    $client_del = new GuzzleHttp\Client();
    $local_del = "http://localhost:3001/usuarios/" . $usuario_id;

    $response_del = $client_del->request('DELETE', $local_del);
    $msg = "Usuário excluído com sucesso!";
}

if ($_GET['oper'] == 'upd') {
    $msg_form = "Atualização de Usuário";
    $msg_oper = "Atualizar";
    $hid_oper = "upd";
    $usuario_id = $_GET['valor'];
    $client_update = new GuzzleHttp\Client();
    $local_upd = "http://localhost:3001/usuarios/" . $usuario_id;
    $response_upd = $client_update->request('GET', $local_upd);
    $msg = "Atualização do usuário.";
    $dados_upd = json_decode($response_upd->getBody());
}


if (isset($_POST['btn_submit'])) {
    $msg_form = "Cadastro de Usuário";
    $msg_oper = "Cadastrar";

    $username = $_POST['username'];
    $email = $_POST['email'];
    $nome_completo = $_POST['nome_completo'];
    $senha = $_POST['senha'];
    $perfil = $_POST['perfil'];
    $ativo = $_POST['ativo'];

    if ($_POST['oper'] == 'upd') {
        // Atualização de usuário

        try {

            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare("update usuarios set username=?, email=?, nome_completo=?, perfil=?, ativo=?, updated_at=? where id = ?");
            $stmt->bindParam(1, $username);
            $stmt->bindParam(2, $email);
            $stmt->bindParam(3, $nome_completo);
            $stmt->bindParam(4, $perfil);
            $stmt->bindParam(5, $ativo);
            $stmt->bindParam(6, date('Y-m-d H:i:s'));
            $stmt->bindParam(7, $_POST['usuario_id']);
            $stmt->execute();
        } catch (PDOException $e) {
            $msg = "Error!: " . $e->getMessage() . "Erro no acesso ao BD";
        }


        /*
        $usuario_id = $_POST['usuario_id'];
        $local_put = "http://localhost:3001/usuarios/" . $usuario_id;

        $client_put = new GuzzleHttp\Client();

        $response_put = $client_put->request('PUT', $local_put, [
            'json' => [
                'username' => $username,
                'email' => $email,
                'nome_completo' => $nome_completo,
                'perfil' => $perfil,
                'ativo' => $ativo,
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
*/
        $msg = "Usuário atualizado com sucesso!";
    }

    if ($_POST['oper'] == 'cre') {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $client_post = new GuzzleHttp\Client();
        $local_post = "http://localhost:3001/usuarios";
        //$local_post = "https://parabolicamara.com.br/univesp/PI_2/api/public/usuarios";

        $response_post = $client_post->request('POST', $local_post, [
            'json' => [
                'username' => $username,
                'email' => $email,
                'senha_hash' => $senha_hash,
                'nome_completo' => $nome_completo,
                'perfil' => $perfil,
                'ativo' => $ativo,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
        $msg = "Usuário cadastrado com sucesso!";
    }
}


$client = new GuzzleHttp\Client();
$resposta = $client->request('GET', 'http://localhost:3001/usuarios');
//$resposta = $client->request('GET', 'https://parabolicamara.com.br/univesp/PI_2/api/public/usuarios');
$dados = json_decode($resposta->getBody());

$smarty->assign("titulo", $msg);
$smarty->assign("dados", $dados);
$smarty->assign("dados_upd", $dados_upd);
$smarty->assign("login", $login);
$smarty->assign("msg_form", $msg_form);
$smarty->assign("msg_oper", $msg_oper);
$smarty->assign("hid_oper", $hid_oper);
$smarty->display("adm_usuario.tpl");
