{extends file="layout.tpl"}
{block name=main}

    <div class="col>
        <!--div class=" p-3 bg-light border rounded"-->

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title ">Cadastramento de Arquivos</h5>
        </div>
        <div class="card-body">

            <form class="row g-3" method="post" action="upload.php" enctype="multipart/form-data">
                <div class="col-md-6">
                    <label for="nome_original" class="form-label">Nome original</label>
                    <input type="text" class="form-control" id="nome_original" name="nome_original" required>
                </div>

                <!-- MIME Type -->
                <div class="col-md-6">
                    <label for="mime_type" class="form-label">Tipo *</label>
                    <select class="form-select" id="mime_type" name="mime_type" required>
                        <option value="">Selecione um tipo...</option>
                        <option value="application/pdf">application/pdf - PDF</option>
                        <option value="image/jpeg">image/jpeg - JPEG</option>
                        <option value="image/png">image/png - PNG</option>
                        <option value="text/plain">text/plain - Texto</option>
                        <option value="application/msword">application/msword - Word</option>
                        <option value="application/vnd.ms-excel">application/vnd.ms-excel - Excel</option>
                        <option value="application/zip">application/zip - ZIP</option>
                        <option value="audio/mpeg">audio/mpeg - MP3</option>
                        <option value="video/mp4">video/mp4 - MP4</option>
                        <option value="outro">Outro</option>
                    </select>
                    <div id="customMimeType" class="mt-2" style="display: none;">
                        <input type="text" class="form-control" id="mime_type_custom" name="mime_type_custom"
                            placeholder="Digite o MIME Type personalizado">
                    </div>
                </div>


                <!-- Descrição -->
                <div class="col-md-6">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="3" maxlength="500"></textarea>
                    <div class="form-text">Descrição opcional do arquivo (máximo 500 caracteres).</div>
                </div>



                <!-- Público -->
                <div class="col-md-6">
                    <label class="form-label">Público *</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="publico" id="publico_sim" value="1"
                                required>
                            <label class="form-check-label" for="publico_sim">Sim</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="publico" id="publico_nao" value="0"
                                required>
                            <label class="form-check-label" for="publico_nao">Não</label>
                        </div>
                    </div>
                    <div class="form-text">Define se o arquivo é público ou privado.</div>
                </div>

                <div class="col-md-6">

                    <label for="formFile" class="form-label">Selecione o arquivo para upload:</label>
                    <input class="form-control" type="file" id="formFile" name="arquivo">
                </div>

                <!-- Botões -->
                <div class="d-grid gap-2">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Cadastrar
                        Arquivo</button>
                    <button type="reset" class="btn btn-outline-secondary">Limpar Formulário</button>
                </div>

            </form>
        </div>
    </div>
    <!--div-->

    <!-- Tabela de uma coluna -->

</div>


<div class="container mt-5">
    <h3>Lista de Arquivos</h3>
</div>

<div class="col">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome original</th>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Público</th>

            </tr>
        </thead>
        <tbody>
            {foreach $dados as $dado}
            <tr>
                <td>{$dado->id}</td>
                <td>{$dado->nome_original}</td>
                <td>{$dado->mime_type}</td>
                <td>{$dado->descricao}</td>
                <td>{$dado->publico}</td>
                <td>
                    <a href="/arquivo/update" class="btn btn-warning btn-sm">Editar</a>
                    <a href="/arquivo/excluir" class="btn btn-danger btn-sm"
                        onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</a>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
{/block}