<!DOCTYPE html>
<html lang="pt-br">

<head>
	<?php require 'conexao.php'; ?>
    <title>Site Pessoal com Bootstrap</title>
    <meta charset = "UTF-8">
    <meta name="viewport" content="width = device-width initial-scale = 1">
    <link href = "css/bootstrap.min.css" rel = "stylesheet">
    <link rel="stylesheet" href="css/stylesobremim.css">

    <script src = "js/jquery.min.js"></script>
    <script src = "js/bootstrap.min.js"></script>   
    
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    
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
	<?php
		require 'conexao.php';

		$id = 0;

		if(!empty($_GET['id']))
		{
			$id = $_REQUEST['id'];
		}

		if(!empty($_POST))
		{
			$id = $_POST['id'];

			//Delete do banco:
			//$pdo = Banco::conectar();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "DELETE FROM pecas where idPeca = '$id'";
			$q = $pdo->prepare($sql);
			$q->execute(array($id));
			//Banco::desconectar();
			header("Location: abc.php");
		}
	?>
	
        <div class="header">
            
		</div> <!-- header -->

            <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #5FC370">
            <a class="navbar-brand" href="index.php" style="color: #2C5C34"><h5>Home</h5></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="color: #2C5C34">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="abc.php" style="color: #2C5C34"><h5>Cadastro</h5><span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="consulta.php" style="color: #2C5C34"><h5>Consulta</h5></a>
                    </li>
                    <li class="nav-item dropdown">
                    </ul>
                    <form class="form-inline my-2 my-lg-0" method="post" action="conexao.php" >
                        <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Search" name="busca">
                        <button class="btn btn-outline-success my-2 my-sm-0" name="btnPesquisarPessoa" type="submit">Pesquisar</button>
                    </form>
                </div>
            </nav><br>
        <div class="container">
          <!-- <div class="jumbotron">
            <div class="row">                
            </div>
          </div> -->          
            <div class="row">
                <p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastrar">Cadastrar</button>
                </p>
                <table id="tabForn" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Fornecedor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
							include 'conexao.php';
						   
							$sql = 'SELECT idPeca, descricao, preco, fornecedor.nomeFantasia FROM fornecedor INNER JOIN pecas ON fornecedor.idFornecedor = pecas.idFornecedor ORDER BY idPeca ASC';

							foreach($pdo->query($sql)as $row)
							{
								echo '<tr>';
									  echo '<th scope="row">'. $row['idPeca'] . '</th>';
								echo '<td>'. $row['descricao'] . '</td>';
								echo '<td>'. $row['preco'] . '</td>';
								echo '<td>'. $row['nomeFantasia'] . '</td>';
								echo '<td width=250>';
								echo '<a class="btn btn-warning" href="update.php?id='.$row['idPeca'].'">Atualizar</a>';
								echo ' ';
								echo '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir" name="btnExcluir">Excluir</button>';
								echo '</td>';
								echo '</tr>';
							}
						?>
						
                    </tbody>
                </table><br><br><br><br><br>
            </div>
        </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>
	
	<script>
		 $('.btnExcluir').click(function(){
			 debugger;
		});
	</script>
	
	<!-- Modal Cadastrar-->
<div class="modal fade" id="modalCadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Título do modal</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
		<div class="modal-body">
			<div class="container-fluid" >
				<div class="row">
					<div class=" col-md" ><br><br>
						<form  method="post">
							<div class="form-group">
								<input type="text" name="descricao" class="form-control" id="desc" placeholder="Descrição">
							</div>

							<div class="form-group">
								<input type="text" name="preco" class="form-control" id="preco" placeholder="Preço">
							</div>
							
							<div class="form-group">
								<input type="text" name="fornecedor" class="form-control" id="forn" placeholder="Código Fornecedor">
							</div>
							
							
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
								<button type="submit" class="btn btn-primary" data-target="#button" >Salvar mudanças</button>
							</div>
						</form>
					</div><!-- fecha col1 -->
				</div> <!-- linha 01 --><br>
			</div> <!--container -->
		</div>
    </div>
  </div>
</div>

<!-- Modal Excluir-->
<div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Título do modal</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
		<div class="modal-body">
			<label>Você deseja mesmo excluir este funcionário?</label>
		</div>
		<div class="modal-footer">
				<form class="form-horizontal" action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>" />
                    <div class="form actions">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
						<button type="submit" class="btn btn-danger" data-target="#button" >Excluir</button>
                    </div>
                </form>
		</div>
    </div>
  </div>
</div>
</body>

</html>
