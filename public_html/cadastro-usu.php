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
      <h2>Cadastrar Usuarios</h2>
      <?php
    	$sql = $pdo->prepare("SELECT F.* FROM funcionario F LEFT JOIN usuario U  ON U.fkFuncionario = F.matricula
WHERE U.fkFuncionario IS NULL");


                       $sql->execute();
                       if($sql->rowCount() > 0 ){
                       	?>
        <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Email</th>
              <th>Cargo</th>
              <th>Cadastrar Usuario</th>
            </tr>
          </thead>
          <tbody>
           <?php
            foreach($sql->fetchAll() as $dados_func){
                        		?>   		
            <tr>
              <td><?php echo $dados_func['nome']; ?></td>
              <td><?php echo $dados_func['email']; ?></td>
              <td><?php if($dados_func['cargo'] == 0){
                    echo 'Dono';             
                  }
                  else{
                    echo "Funcionario";
                  }  ?>                  
              </td>                       
     			    <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $dados_func['nome']; ?>" data-whateverid="<?php echo $dados_func['matricula']; ?>">Cadastrar</button>
  				    </td>
            </tr>
          
        <?php 
                        }
                    }      
      ?>
      </tbody>
        </table>
      </div>
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar usuario de: </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="cadastro-usu-sql.php">
       
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Login</label>
            <input type="text" name="login" class="form-control" id="recipient-name" placeholder="Novo Login">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Senha</label>
            <input type="password" name="senha" class="form-control" id="recipient-name" placeholder="Nova Senha">
          </div>
             <div class="form-group">            
           <input name="idusu" type="hidden" class="form-control" id="id-curso" value="">
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Botão que acionou o modal
  var recipient = button.data('whatever') // Extrai informação dos atributos data-*
  var recipientid = button.data('whateverid')
  // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
  // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
  var modal = $(this)
  modal.find('.modal-title').text('Cadastrar usuario de: ' + recipient)
  //modal.find('.modal-body input').val(recipient)
  modal.find('#id-curso').val(recipientid)
})
</script>
    </main>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
        <script src="assets/js/feather.min.js"></script>
        <script src="assets/js/Chart.min.js"></script>
        <script src="assets/js/dashboard.js"></script>
    <script>
function setaDadosModal(valor) {
    document.getElementById('campo').value = valor;

}
</script></body>
</html>

<h1>Dono </h1>
<a href="sair.php">SAIR</a>
