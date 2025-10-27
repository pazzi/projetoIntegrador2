<?php
require 'config/config.php';
include 'db.php';
session_start();
// Configurações
$uploadDir = __DIR__ . '/uploads/';
$maxFileSize = 100 * 1024 * 1024; // 100MB
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


    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $checkStmt = $dbh->prepare("SELECT id, nome_original FROM arquivos WHERE checksum_sha256 = ?");
    $checkStmt->execute([$fileHash]);
    $existingFile = $checkStmt->fetch();

    if ($existingFile) {
        // Arquivo duplicado - remover o arquivo recém-enviado
        unlink($filePath);
    }


    if (isset($_POST['submit'])) {

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
            $stmt->bindParam(9, $_SESSION['user_id']);

            if ($stmt->execute())
                header("location:inicio_adm.php");
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "Erro no acesso ao BD";
            die();
        }
    }
} catch (Exception $e) {
    // Log do erro
    error_log("Erro no upload: " . $e->getMessage());
}
header("location:inicio_adm.php");
