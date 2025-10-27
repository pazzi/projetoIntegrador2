<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$titulo}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        .row {
            padding-bttom: 8px;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <!-- Navbar content -->
        <div class="container">
            <h2 class="navbar-brand">Gestão de Arquivos Corporativos - Alpha 7</h2>
            <h2 class="navbar-brand">{$login}</h2>

        </div>

    </nav>

    <div class="container" style="padding-top: 20px;">
        <div class="row">
            <h3>{$titulo}</h3>
        </div>
        <div class="row">
            <div class="col">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link btn btn-light" href="/adm_usuario.php">Gerenciar Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-light" href="/adm_arquivo.php">Gerenciar Arquivos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-light" href="/logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
        {block name=main}{/block}

    </div>

</body>

</html>