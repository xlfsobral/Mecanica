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
      <h2>Funcionarios</h2>
      <?php
     $sql = $pdo->prepare("SELECT idUsuario, login, nome, email FROM usuario INNER JOIN funcionario on usuario.idUsuario = funcionario.matricula;");
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
              <th>Alterar</th>
              <th>Apagar</th>
            </tr>
          </thead>
          <tbody>
           <?php
            foreach($sql->fetchAll() as $dados_func){
              
                            ?>      
            <tr>
              <td><?php echo $dados_func['idUsuario']; ?></td>
              <td><?php echo $dados_func['login']; ?></td>               
              <td><?php echo $dados_func['nome']?> </td>
              <td><?php echo $dados_func['email']?> </td>
              <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $dados_func['nome']; ?>" data-whateverid="<?php echo $dados_func['idUsuario']; ?>">Alterar</button></td>
              <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#apagarmodal" data-whatevernome="<?php echo $dados_func['nome']; ?>" data-whateverid2="<?php echo $dados_func['idUsuario']; ?>">Apagar</button></td>          
            </tr>          
        <?php 
                        }
                    }      
      ?>
      </tbody>
        </table>
      </div>
      <!-- Modal Alterar -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alterar usario de: </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="alterar-usu.php">
       
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
        <button type="submit" class="btn btn-primary">Alterar</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
 <!-- Fim modal Alterar 

 Modal Apagar -->
<div class="modal fade" id="apagarmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apagar usario de: </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="alert alert-danger" role="alert">
      <center>Voce deseja realmente  apagar o usuario?</center>
      </div>
      <div class="modal-body">
        <form method="POST" action="apagar-usu.php">                          
           <input name="idusu" type="hidden" class="form-control" id="id-curso" value="">                 
         <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Apagar</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
<!-- Fim modal Apagar
 Js Alterar Modal  -->
<script type="text/javascript">
  $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Botão que acionou o modal
  var recipient = button.data('whatever') // Extrai informação dos atributos data-*
  var recipientid = button.data('whateverid')
  // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
  // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
  var modal = $(this)
  modal.find('.modal-title').text('Alterar usario de: ' + recipient)
  //modal.find('.modal-body input').val(recipient)
  modal.find('#id-curso').val(recipientid)
})
</script>
<!-- Fim Js Altear
Js Apagar -->
<script type="text/javascript">
  $('#apagarmodal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Botão que acionou o modal
  var recipient = button.data('whatevernome') // Extrai informação dos atributos data-*
  var recipientid2 = button.data('whateverid2')
  // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
  // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
  var modal = $(this)
  modal.find('.modal-title').text('Apagar o usario: ' + recipient)
  //modal.find('.modal-body input').val(recipient)
  modal.find('#id-curso').val(recipientid2)
})
</script>
<!-- Fim Js Apagar -->
    </main>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
        <script src="assets/js/feather.min.js"></script>
        <script src="assets/js/Chart.min.js"></script>
        <script src="assets/js/dashboard.js"></script>
  </body>
</html>

<h1>Dono </h1>
<a href="sair.php">SAIR</a>
