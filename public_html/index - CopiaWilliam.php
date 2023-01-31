<!doctype html>
<html lang="pt-br">
  <head>
   <?php require 'header.php'; ?>
   
   <style>
 body { 
	width: 100%;
	height:100%;
	font-family: 'Open Sans', sans-serif;
	background: #092756;
	background: -moz-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%),-moz-linear-gradient(top,  rgba(57,173,219,.25) 0%, rgba(42,60,87,.4) 100%), -moz-linear-gradient(-45deg,  #670d10 0%, #092756 100%);
	background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -webkit-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -webkit-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
	background: -o-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -o-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -o-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
	background: -ms-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -ms-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -ms-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
	background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), linear-gradient(to bottom,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), linear-gradient(135deg,  #670d10 0%,#092756 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3E1D6D', endColorstr='#092756',GradientType=1 );
}
   
   .login {
	   background-color:#373434;
	   transition: 2s;
	   transform: scale(1.1);
	}
	.login:hover{
		box-shadow: 0px 0px 90px #000000;
		
	}
.login h1 { color: #fff; text-shadow: 0 0 10px rgba(0,0,0,0.3); letter-spacing:1px; text-align:center; }
   #inputEmail, inputPassword { 
	width: 100%; 
	margin-bottom: 10px; 
	background: rgba(0,0,0,0.3);
	border: none;
	outline: none;
	padding: 10px;
	font-size: 13px;
	color: #fff;
	text-shadow: 1px 1px 1px rgba(0,0,0,0.3);
	border: 1px solid rgba(0,0,0,0.3);
	border-radius: 4px;
	box-shadow: inset 0 -5px 45px rgba(100,100,100,0.2), 0 1px 1px rgba(255,255,255,0.2);
	-webkit-transition: box-shadow .5s ease;
	-moz-transition: box-shadow .5s ease;
	-o-transition: box-shadow .5s ease;
	-ms-transition: box-shadow .5s ease;
	transition: box-shadow .5s ease;
}
#inputEmail:focus { box-shadow: inset 0 -5px 45px rgba(100,100,100,0.4), 0 1px 1px rgba(255,255,255,0.2); }
#inputPassword:focus { box-shadow: inset 0 -5px 45px rgba(100,100,100,0.4), 0 1px 1px rgba(255,255,255,0.2); }
   </style>
  </head>
  <?php 
		session_start();

		
		//var_dump($_SESSION);
    if(isset($_POST['login']) && !empty($_POST['login'])){
    $login = $_POST['login'];
    $senha = sha1($_POST['senha']);
    $sql = $pdo->prepare("SELECT * FROM Usuario WHERE usuario = :login AND senha = :senha");
    $sql->bindValue(":login",$login,PDO::PARAM_STR);
     $sql->bindValue(":senha",$senha,PDO::PARAM_STR);
    $sql->execute();

    if($sql->rowCount() > 0 ){
      $dado = $sql->fetch();
      var_dump($dado);
      if ($dado['idFuncionario'] == 0){
      $_SESSION =  array ('id'  => $dado['id'] );
      
    
      header("Location: restrito-dono.php"); 
    }
    else {
       $_SESSION =  array ('id'  => $dado['id'] );
      header("Location: restrito-comum.php");
    }
  }
 else{
    echo ' <h1 class="h3 mb-3 font-weight-normal alert alert-danger erro" role="alert">Algo deu errado, Tente Novamente</h1>';
  }
    }
  
 ?>
<body class="text-center">
  <div class="container">
	<div class="row">
		<div class="col-lg-12"> 
			<form class="form-signin" method="POST">
				<div class="col-lg-12 login">
					<img class="mb-4" src="assets/img/logo.png" alt="" width="72" height="72">
					<h1>Login</h1>
				  <label for="inputEmail" class="sr-only">Endereço de email</label>
				  <input id="input" type="text" id="inputEmail" class="form-control" placeholder="Email" name="login" autofocus required="required">
				  <label for="inputPassword" class="sr-only">Senha</label>
				  <input id="input" type="password" id="inputPassword" class="form-control" placeholder="Senha" name="senha" required="required">
				  <div class="checkbox mb-3">
					<label>
					  <input type="checkbox" value="remember-me"> Lembrar de mim
					</label>
				  </div>
				  <button class="btn btn-primary btn-block btn-large" type="submit">Entrar</button>
				  <p class="mt-5 mb-3 text-muted">&copy; Copyright <?php echo date("Y"); ?></p>
				</div>
			</form>
		</div>
	</div>
  </div>
</body>

  <!--<body class="text-center">
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
      <p class="mt-5 mb-3 text-muted">&copy; <?php echo date("Y"); ?></p>
    </form>
    <a href="restrito-comum.php">Restrito Comum</a>
    <br>
    <a href="restrito-dono.php">Restrito Dono</a>
  </body>-->
</html>
