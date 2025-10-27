{extends file="layout.tpl"}
{block name=main}

    <div class="container mt-4">
        <div class="row">
            <!-- Coluna da Esquerda - Formulário -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Cadastro de Usuário</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="cad_user.php" enctype="multipart/form-data">

                            <!-- Username -->
                            <div class="mb-3">
                                <label for="username" class="form-label">Username *</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                                <div class="form-text">Nome de usuário único para login.</div>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="form-text">Email válido do usuário.</div>
                            </div>

                            <!-- Senha Hash -->
                            <div class="mb-3">
                                <label for="senha_hash" class="form-label">Senha *</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="senha_hash" name="senha_hash" required>
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                <div class="form-text">A senha será convertida em hash automaticamente.</div>
                            </div>

                            <!-- Nome Completo -->
                            <div class="mb-3">
                                <label for="nome_completo" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" id="nome_completo" name="nome_completo">
                                <div class="form-text">Nome completo do usuário (opcional).</div>
                            </div>

                            <!-- Perfil -->
                            <div class="mb-3">
                                <label for="perfil" class="form-label">Perfil *</label>
                                <select class="form-select" id="perfil" name="perfil" required>
                                    <option value="">Selecione um perfil...</option>
                                    <option value="ADMIN">ADMIN - Administrador</option>
                                    <option value="USER">USER - Usuário Comum</option>
                                </select>
                                <div class="form-text">Defina o nível de acesso do usuário.</div>
                            </div>

                            <!-- Ativo -->
                            <div class="mb-3">
                                <label class="form-label">Status *</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ativo" id="ativo_sim" value="1"
                                            checked required>
                                        <label class="form-check-label" for="ativo_sim">Ativo</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="ativo" id="ativo_nao" value="0"
                                            required>
                                        <label class="form-check-label" for="ativo_nao">Inativo</label>
                                    </div>
                                </div>
                                <div class="form-text">Define se o usuário está ativo no sistema.</div>
                            </div>

                            <!-- Botões -->
                            <div class="d-grid gap-2">
                                <button name="submit" value="submit" type="submit" class="btn btn-primary">Cadastrar
                                    Usuário</button>
                                <button type="reset" class="btn btn-outline-secondary">Limpar Formulário</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <!--div class="p-3 bg-light border rounded"-->

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Cadastramento de Arquivos</h5>
                    </div>
                    <div class="card-body">

                        <form method="post" action="upload.php" enctype="multipart/form-data">
                            <label for="nome_original" class="form-label">Nome original</label>
                            <input type="text" class="form-control" id="nome_original" name="nome_original" required>


                            <!--div class="card-body">
                            <label for="nome_armazenamento" class="form-label">Nome de Armazenamento *</label>
                            <input type="text" class="form-control" id="nome_armazenamento" name="nome_armazenamento"
                                required>
                            <div class="form-text">Nome único para identificar o arquivo no sistema.</div>
                        </div-->

                            <!-- MIME Type -->
                            <div class="mb-3">
                                <label for="mime_type" class="form-label">MIME Type *</label>
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
                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição</label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="3"
                                    maxlength="500"></textarea>
                                <div class="form-text">Descrição opcional do arquivo (máximo 500 caracteres).</div>
                            </div>



                            <!-- Público -->
                            <div class="mb-3">
                                <label class="form-label">Público *</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="publico" id="publico_sim"
                                            value="1" required>
                                        <label class="form-check-label" for="publico_sim">Sim</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="publico" id="publico_nao"
                                            value="0" required>
                                        <label class="form-check-label" for="publico_nao">Não</label>
                                    </div>
                                </div>
                                <div class="form-text">Define se o arquivo é público ou privado.</div>
                            </div>

                            <div class="mb-3">

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
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Arquivos</th>
                                    </tr>
                                    {section name=i loop=$dados}
                                        <tr>
                                            <td><a href='.\download.php?file={$dados[i].nome_armazenamento}'
                                                    class="text-decoration-none link-dark">{$dados[i].nome_original} -
                                                    {$dados[i].descricao}</a></td>
                                        </tr>
                                    {/section}
                            </table>
                        </div>
                    </div>
                </div>
            </div>

{/block}