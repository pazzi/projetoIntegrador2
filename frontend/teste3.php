<html>

<body>
    <h2>Upload de Arquivo</h2>
    <form action="teste4.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="3000000" /> <!-- 3MB limit -->
        <label for="fileToUpload">Selecione o arquivo para upload:</label>
        <input type="file" name="fileToUpload" id="fileToUpload" />
        <input type="submit" value="Enviar Arquivo" name="submit" />
    </form>
</body>

</html>