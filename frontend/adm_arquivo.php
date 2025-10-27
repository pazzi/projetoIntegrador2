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

if ($_GET['oper'] == "del") {
    $arquivo_id = $_GET['valor'];
    $client = new GuzzleHttp\Client();
    $local_del = "http://localhost:3001/arquivos/" . $arquivo_id;

    $response_del = $client->request('DELETE', $local_del);
    $msg = "Arquivo excluído com sucesso!";
} else {

    if ($_POST['submit'] == 'submit') {
        $uploadDir = __DIR__ . '/uploads/';
        $maxFileSize = 10 * 1024 * 1024; // 10MB
        $allowedTypes = []; // Todos os tipos permitidos

        // Criar diretório de uploads se não existir
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        function generateFileName($originalName)
        {
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $baseName = pathinfo($originalName, PATHINFO_FILENAME);

            // Gerar nome único: nome_base-timestamp-random.extension
            $timestamp = time();
            $random = bin2hex(random_bytes(4));

            return $baseName . '-' . $timestamp . '-' . $random . '.' . $extension;
        }

        function calculateFileHash($filePath)
        {
            return hash_file('sha256', $filePath);
        }

        function sanitizeFileName($fileName)
        {
            // Remove caracteres especiais, mantém apenas alfanuméricos, hífen, underline e ponto
            $sanitized = preg_replace('/[^a-zA-Z0-9\-_.]/', '', $fileName);
            return $sanitized ?: 'arquivo';
        }

        try {
            // Verificar se o arquivo foi enviado
            if (!isset($_FILES['arquivo']) || $_FILES['arquivo']['error'] !== UPLOAD_ERR_OK) {
                throw new Exception('Erro no upload do arquivo. Código: ' . $_FILES['arquivo']['error']);
            }

            $file = $_FILES['arquivo'];

            // Validar tamanho do arquivo
            if ($file['size'] > $maxFileSize) {
                throw new Exception('Arquivo muito grande. Tamanho máximo: 100MB.');
            }

            // Validar se é um arquivo válido
            if (!is_uploaded_file($file['tmp_name'])) {
                throw new Exception('Arquivo inválido.');
            }

            // Gerar nome único para armazenamento
            $originalName = sanitizeFileName($file['name']);
            $storageName = generateFileName($originalName);
            $filePath = $uploadDir . $storageName;

            // Mover arquivo para diretório de uploads
            if (!move_uploaded_file($file['tmp_name'], $filePath)) {
                throw new Exception('Erro ao salvar arquivo no servidor.');
            }

            // Calcular hash SHA256
            $fileHash = calculateFileHash($filePath);

            // Verificar se o arquivo foi corretamente salvo
            if (!file_exists($filePath)) {
                throw new Exception('Erro: arquivo não foi salvo corretamente.');
            }
        } catch (Exception $e) {
            // Log do erro
            error_log("Erro no upload: " . $e->getMessage());
        }

        //require 'vendor/autoload.php';
        try {
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare("insert into arquivos (nome_original, nome_armazenamento, mime_type,
         checksum_sha256, descricao, publico, created_at, updated_at, usuario_upload_id)
          values (?,?,?,?,?,?,?,?,?)");

            $stmt->bindParam(1, $originalName);
            $stmt->bindParam(2, $storageName);
            $stmt->bindParam(3, $_POST['mime_type']);
            $stmt->bindParam(4, $fileHash);
            $stmt->bindParam(5, $_POST['descricao']);
            $stmt->bindParam(6, $_POST['publico']);
            $stmt->bindParam(7, date('Y-m-d H:i:s'));
            $stmt->bindParam(8, date('Y-m-d H:i:s'));
            $stmt->bindParam(9, $_SESSION['usuario_id']);

            $stmt->execute();
            $msg = "Arquivo adicionado com sucesso.";
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "Erro no acesso ao BD";
            die();
        }
    }
}

$msg = "Gestão de Arquivos";
$client = new GuzzleHttp\Client();

$resposta = $client->request('GET', 'http://localhost:3001/arquivos');
$dados = json_decode($resposta->getBody());

$smarty->assign("login", $login);
$smarty->assign("titulo", $msg);
$smarty->assign("dados", $dados);
$smarty->assign("msg", $msg);
$smarty->display("adm_arquivo.tpl");
