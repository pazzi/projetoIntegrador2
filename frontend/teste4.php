<?php
$target_dir = "./uploads/"; // Diretório onde os arquivos serão salvos
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Verifica se o arquivo é uma imagem real (opcional, para uploads de imagem)
// $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
// if($check !== false) {
//     echo "O arquivo é uma imagem - " . $check["mime"] . ".";
//     $uploadOk = 1;
// } else {
//     echo "O arquivo não é uma imagem.";
//     $uploadOk = 0;
// }

// Verifica se o arquivo já existe
if (file_exists($target_file)) {
    echo "Desculpe, o arquivo já existe.";
    $uploadOk = 0;
}

// Verifica o tamanho do arquivo (exemplo: max 500KB)
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Desculpe, seu arquivo é muito grande.";
    $uploadOk = 0;
}

// Permite apenas certos formatos de arquivo (exemplo: JPG, JPEG, PNG, GIF)
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Desculpe, apenas arquivos JPG, JPEG, PNG & GIF são permitidos.";
    $uploadOk = 0;
}

// Verifica se $uploadOk está definido como 0 por algum erro
if ($uploadOk == 0) {
    echo "Desculpe, seu arquivo não foi enviado.";
    // Se tudo estiver ok, tenta fazer o upload do arquivo
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "O arquivo " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " foi enviado com sucesso.";
    } else {
        echo "Desculpe, houve um erro ao enviar seu arquivo.";
    }
}
