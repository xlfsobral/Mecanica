<!doctype html>
<html lang="pt-br">
  <head>
  	<link rel="stylesheet" type="text/css" href="assets/css/stylelogin.css">
   <?php require 'header.php'; ?>
  </head>
   <?php
    session_start();
    if(isset($_SESSION['idcargo']) && !empty($_SESSION['idcargo']) == 0){

     header("Location: restrito-dono.php");
    } 
?>
  <body class="text-center">
    <form class="form-signin" method="POST">
      <img class="mb-4" src="assets/img/logo.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Faça login</h1>
      <label for="inputEmail" class="sr-only" >Endereço de email</label>
      <input type="text" id="inputEmail" class="form-control" placeholder="Seu email" name="login"  autofocus>
      <label for="inputPassword" class="sr-only" >Senha</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Senha" name="senha">
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Lembrar de mim
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit" >Login</button>
      	<hr>
       <?php
    if(isset($_POST['login']) && !empty($_POST['login'])){
    $login = $_POST['login'];
    $senha = sha1($_POST['senha']);
   
    $sql = $pdo->prepare("SELECT idUsuario, login, senha, funcionario.cargo FROM usuario INNER JOIN funcionario on funcionario.matricula = usuario.fkFuncionario AND usuario.login = :login AND usuario.senha = :senha");
    $sql->bindValue(":login",$login,PDO::PARAM_STR);
     $sql->bindValue(":senha",$senha,PDO::PARAM_STR);
    $sql->execute();  	

    if($sql->rowCount() > 0 ){
      $dado = $sql->fetch();

      if ($dado['cargo'] == 0){
      $_SESSION =  array ('id'  => $dado['idUsuario'], 'idcargo' => $dado['cargo'] );
      
    
      header("Location: restrito-dono.php"); 
    }
    else {
       $_SESSION =  array ('id'  => $dado['idUsuario'], 'idcargo' => $dado['cargo'] );
      header("Location: restrito-comum.php");
    }
  }
 else{
    echo ' <h1 class="h3 mb-3 font-weight-normal alert alert-danger erro" role="alert">Algo deu errado, Tente Novamente</h1>';
  }
    }
  
 ?>

      <p class="mt-5 mb-3 text-muted">&copy; <?php echo date("Y"); ?></p>

    </form>
  </body>
</html>
