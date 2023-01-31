<?php
		require 'conexao.php';

		
		$id = $_GET['id'];


		$sql = "SELECT * FROM pecas where idPeca = $id";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);

		var_dump($data);

		?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<style type="text/css">
		.inv{
			display: none;
		}
	</style>
	<form method="POST" action="atualizar.php">
		<input class="inv" type="text" name="id" value="<?php echo $_GET['id'] ?>">
		<div class="form-group">
		<label for="exampleInputEmail1">Descrição da peça</label>
		<input type="text" class="form-control" id="descricao" value="<?php echo $data['descricao']?>" name="descricao">
		</div>
		<div class="form-group">
		<label for="exampleInputPassword1">Preço</label>
		<input type="text" class="form-control" id="preco" value="<?php echo $data['preco']?>" name="preco">
		</div>
		<div class="form-group">
		<label for="exampleInputPassword1">Código do fornecedor</label>
		<input type="text" class="form-control" id="fornecedor" value="<?php echo $data['idFornecedor']?>" name="idFornecedor">
		</div>
		
		<button type="submit" class="btn btn-primary" >Enviar</button>
		</form>

</body>
</html>