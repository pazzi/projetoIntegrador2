{extends file="layout.tpl"}
{block name=main}

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
                            <a href="./uploads/{$dado->nome_armazenamento}" class="btn btn-warning btn-sm">Obter Arquivo</a>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
{/block}