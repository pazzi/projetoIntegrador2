{extends file="layout.tpl"}
{block name=main}
  {$msg} <br>

  <div class="container mt-3">
    <h3>Validação de usuários</h3>
    <p>Insira o userid e senha e aperte "Login".</p>
    <form method="POST" action="login.php">
      <div class="row">
        <div class="col">
          <input type="text" class="form-control" placeholder="Username" name="username">
        </div>
        <div class="col">
          <input type="password" class="form-control" placeholder="Senha" name="passwd">
        </div>
        <div class="col">
          <button type="submit" class="btn btn-primary" name="login" value="Login">Login</button>
        </div>
      </div>
    </form>
  </div>

{/block}