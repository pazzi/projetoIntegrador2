{extends file="layout.tpl"}
{block name=main}
    <div class="container">
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">{$msg_form}</h5>
                </div>
                <div class="card-body">
                    <form class="row g-3" id="usuarioForm" method="POST" action="adm_usuario.php">
                        <input type="hidden" name="oper" value="{$hid_oper|default:'cre'}">
                        <input type="hidden" name="usuario_id" value="{$dados_upd->id|default:''}">
                        <!-- Username -->
                        <div class="col-md-6">
                            <label for="username" class="form-label">Username *</label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="{$dados_upd->username|default:''}" required>
                            <div class="form-text">Nome de usuário único para login.</div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{$dados_upd->email|default:''}" required>
                            <div class="form-text">Email válido do usuário.</div>
                        </div>

                        <!-- Nome Completo -->
                        <div class="col-md-9">
                            <label for="nome_completo" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="nome_completo" name="nome_completo"
                                value="{$dados_upd->nome_completo|default:''}" required>
                            <div class="form-text">Nome completo do usuário (opcional).</div>
                        </div>
                        {if  !isset($dados_upd)}
                            <!-- Senha Hash -->
                            <div class="col-md-3">
                                <label for="senha_hash" class="form-label">Senha *</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="senha_hash" name="senha_hash" required>
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                <div class="form-text">A senha será convertida em hash automaticamente.</div>
                            </div>
                        {/if}

                        <!-- Perfil -->
                        <div class="col-md-3">
                            <label for="perfil" class="form-label">Perfil *</label>
                            <select class="form-select" id="perfil" name="perfil" required>
                                <option value="">Selecione um perfil...</option>
                                <option value="ADMIN" {if $dados_upd->perfil=="ADMIN"} SELECTED{/if}>ADMIN - Administrador
                                </option>
                                <option value="USER" {if $dados_upd->perfil=="USER"} SELECTED{/if}>USER - Usuário Comum
                                </option>
                            </select>
                            <div class="form-text">Defina o nível de acesso do usuário.</div>
                        </div>

                        <!-- Ativo -->
                        <div class="col-md-3">
                            <label class="form-label">Status *</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="ativo" id="ativo_sim" value="1"
                                        {if $dados_upd->ativo == 1}checked{/if} required>
                                    <label class="form-check-label" for="ativo_sim">Ativo</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="ativo" id="ativo_nao" value="0"
                                        {if $dados_upd->ativo == 0}checked{/if} required>
                                    <label class="form-check-label" for="ativo_nao">Inativo</label>
                                </div>
                            </div>
                            <div class="form-text">Define se o usuário está ativo no sistema.</div>
                        </div>

                        <!-- Botões -->
                        <div class="d-grid gap-2">
                            <button name="btn_submit" type="submit" class="btn btn-primary">{$msg_oper} Usuário</button>
                            <button type="reset" class="btn btn-outline-secondary">Limpar Formulário</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


    <div class="container mt-5">
        <h3>Lista de Usuários</h3>
    </div>


    <div class="col">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Nome completo</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th>Ativo</th>

                </tr>
            </thead>
            <tbody>
                {foreach from=$dados  item=$dado}
                    <tr>
                        <td>{$dado->id}</td>
                        <td>{$dado->username}</td>
                        <td>{$dado->nome_completo}</td>
                        <td>{$dado->email}</td>
                        <td>{$dado->perfil}</td>
                        <td>{$dado->ativo}</td>


                        <td>
                            <a href="/adm_usuario.php?oper=upd&valor={$dado->id}" class="btn btn-warning btn-sm">Editar</a>
                            <a href="/adm_usuario.php?oper=del&valor={$dado->id}" class="btn btn-danger btn-sm"
                                onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</a>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
{/block}