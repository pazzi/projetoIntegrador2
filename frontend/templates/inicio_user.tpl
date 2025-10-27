{include file="header.tpl"}
{include file="nav.tpl"}

<div class="container-mt3">
    //uploaded files
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Cadastro de Usuário</h5>
            </div>
            <div class="card-body">
                <form id="usuarioForm">
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
                        <button type="submit" class="btn btn-primary">Cadastrar Usuário</button>
                        <button type="reset" class="btn btn-outline-secondary">Limpar Formulário</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Arquivos Disponíveis para Download</th>
                </tr>
                {section name=i loop=$dados}
                    <tr>
                        <td><a href='.\mostra_arquivo.php?cod={$dados[i].id_arquivo}'
                                class="text-decoration-none link-dark">{$dados[i].nome_armazenamento} -
                                {$dados[i].descricao}</a></td>
                    </tr>
                {/section}
        </table>
    </div>
</div>

{include file="footer.tpl"}