	<?php 
			require 'conexao.php';


			
			$descricao = $_POST['descricao'];
			$preco = $_POST['preco'];
			$fornecedor = $_POST['fkFornecedor'];
			$id = $_POST['id'];

			$sql2 = $pdo->prepare("UPDATE pecas SET idPeca = :id, descricao = :descricao, preco = :preco, fkFornecedor = :fkFornecedor WHERE idPeca = $id");
                   
                    
						$sql2->bindValue(":id",$id,PDO::PARAM_STR);
           				$sql2->bindValue(":descricao",$descricao,PDO::PARAM_STR);
						$sql2->bindValue(":preco",$preco,PDO::PARAM_STR);
						$sql2->bindValue(":fkFornecedor",$fornecedor,PDO::PARAM_STR);
						$sql2->execute();
						header("Location: pecas.php");  

		 ?>
