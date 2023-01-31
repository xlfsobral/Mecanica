<!DOCTYPE html>
<html>
<head>
  <?php
    require 'header.php';
session_start();
if(isset($_SESSION['id']) && !empty($_SESSION['id'])){
} 
else{
  header("Location: index.php");
}
?>
</head>
  <body>
    <?php
      require 'menu.php';
    ?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <form method="POST" action="cadastro-func-sql.php">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Nome</label>
      <input type="text" name="nome" class="form-control" placeholder="Nome">
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="Email" name="email" class="form-control" placeholder="Email">
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-6">
      <label for="inputEmail4">RG</label>
      <input type="text" name="rg" class="form-control" placeholder="RG" onkeypress="mascara(this, '##.###.###-#')" maxlength="12">
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">CPF</label>
      <input type="text" name="cpf" class="form-control" placeholder="CPF" onkeypress="mascara(this, '###.###.###-##')" maxlength="14">
    </div>
  </div>
  <div class="form-row">
      <div class="form-group col-md-6">
      <label for="inputEmail4">Telefone</label>
      <input type="text" name="telefone" class="form-control" placeholder="Telefone" onkeypress="mascara(this, '## ####-####')" maxlength="12">
    </div>
  <div class="form-group col-md-6">
      <label for="inputEmail4">Celular</label>
      <input type="text" name="celular" class="form-control" placeholder="Celular" onkeypress="mascara(this, '## #####-####')" maxlength="13">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Rua</label>
    <input type="text" name="rua" class="form-control"  placeholder="Rua Exemplo">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Bairro</label>
    <input type="text" name="bairro" class="form-control"  placeholder="Bairro Exemplo">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Cidade</label>
      <input type="text" name="cidade" class="form-control"  placeholder="Cidade Exemplo">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Função</label>
      <select name="cargo" class="form-control">
        <option selected>Escolha</option>
        <option value="0">Dono</option>
        <option value="1">Funcionario</option>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group">
    <label for="inputAddress2">Salário</label>
    <input type="text" name="salario" class="form-control"  placeholder="Salário">
  </div>
  </div>
  <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>
    </main>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
        <script src="assets/js/feather.min.js"></script>
        <script src="assets/js/Chart.min.js"></script>
        <script src="assets/js/dashboard.js"></script></body>
</html>



