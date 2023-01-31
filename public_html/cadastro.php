<!DOCTYPE html>
<html>
<head>
	<?php require 'conexao.php'; ?>
	<title>Site Pessoal com Bootstrap</title>
	<meta name="viewport" content="width = device-width initial-scale = 1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<?php


						if(isset($_POST['descricao']) && !empty($_POST['descricao'])){
						
						$descricao = $_POST['descricao'];
						$preco = $_POST['preco'];
						$fornecedor = $_POST['fornecedor'];

						$sql = $pdo->prepare("INSERT INTO `pecas`(`idPeca`, `descricao`, `preco`, `idFornecedor`) VALUES (DEFAULT, :descricao, :preco, :idFornecedor)");
						$sql->bindValue(":descricao",$descricao,PDO::PARAM_STR);
						$sql->bindValue(":preco",$preco,PDO::PARAM_STR);
						$sql->bindValue(":idFornecedor",$fornecedor,PDO::PARAM_STR);
						$sql->execute();
						 header("Location: abc.php");  
}
	?>

	<div class="header">
		
	</div> <!-- header -->

			<nav class="menu-responsivo">
			
			</nav>		

			


	<div class="container-fluid" >
		
		<div class="row">
			
			<div class=" col-md" ><br><br>
				<form  method="post">
				<div class="form-group">
					<label for="usr">Descrição</label>
					<input type="text" name="descricao" class="form-control" id="desc" >
				</div>

				<div class="form-group">
					<label for="usr">Preço</label>
					<input type="text" name="preco" class="form-control" id="preco" >
				</div>
				
				<div class="form-group">
					<label for="usr">Fornecedor</label>
					<input type="text" name="fornecedor" class="form-control" id="forn" >
				</div>
				
			</div><!-- fecha col1 -->
			
			
		</div> <!-- linha 01 --><br>

		<div align="right">	
			<button type= "submit"  class="btn btn-primary" data-target="#button">SALVAR</button>&nbsp&nbsp&nbsp&nbsp<button type= "submit" class="btn btn-primary" data-target="#button">CANCELAR</button>
		</div><br>
	</form>
	</div> <!--container -->

</body>
</html>