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
     <hr>
      <div class="container">
      <div class="row">
        <div class="col-md-9">
          <h2>Fornecedor</h2>
        </div>
        <div class="col-md-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalcadastrar">Cadastar Fornecedor</button>
      </div>
      </div>
      </div>
      <?php
     $sql = $pdo->prepare("SELECT * FROM Fornecedor");
     $sql->execute();    
                       if($sql->rowCount() > 0 ){
                        ?>
        <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Razao Social</th>
              <th>Nome Fantasia</th>
              <th>CNPJ</th>
              <th>Endereco</th>
              <th>Email</th>
              <th>Contato</th>
              <th>Alterar</th>
              <th>Excluir</th>

            </tr>
          </thead>
          <tbody>
           <?php
            foreach($sql->fetchAll() as $dados_func){
              
                            ?>      
            <tr>
              <td><?php echo $dados_func['razaoSocial']; ?></td>
              <td><?php echo $dados_func['nomeFantasia']; ?></td>               
              <td><?php echo $dados_func['cnpj']?> </td>
              <td><?php echo $dados_func['rua'].", ".$dados_func['numero'].", ".$dados_func['bairro'].", ".$dados_func['cidade']."-".$dados_func['estado']; ?></td>
              <td><?php echo $dados_func['email']?> </td>
              <td><?php echo $dados_func['telefone']?> </td>
              <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $dados_func['nomeFantasia']; ?>" data-whateverid="<?php echo $dados_func['idFornecedor']; ?>" data-whateverrazao="<?php echo $dados_func['razaoSocial']; ?>" data-whatevernome="<?php echo $dados_func['nomeFantasia']; ?>" data-whatevercnpj="<?php echo $dados_func['cnpj']; ?>" data-whateverrua="<?php echo $dados_func['rua']; ?>" data-whatevernumero="<?php echo $dados_func['numero']; ?>" data-whateverbairro="<?php echo $dados_func['bairro']; ?>" data-whatevercidade="<?php echo $dados_func['cidade']; ?>" data-whateveremail="<?php echo $dados_func['email']; ?>" data-whateverestado="<?php echo $dados_func['estado']; ?>" data-whatevertel="<?php echo $dados_func['telefone']; ?>">Alterar</button></td>



              <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#apagarmodal" data-whatevernome="<?php echo $dados_func['nomeFantasia']; ?>" data-whateverid2="<?php echo $dados_func['idFornecedor']; ?>">Apagar</button></td>          
            </tr>          
        <?php 
                        }
                    }      
      ?>
      </tbody>
        </table>
      </div>
      <!-- Modal Alterar -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">   
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastro de Funcionario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="container">
       <form method="POST" action="alterar-forn.php">
       <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Razao Social</label>
            <input type="text" name="razaosocial" class="form-control" id="razaosocial" placeholder="Razao Social" required>
          </div>
           <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Nome Fantasia</label>
            <input type="text" name="nomefantasia" class="form-control" id="nomefantasia" placeholder="Nome Fantasia" required>
          </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">CNPJ</label>
            <input type="text" name="cnpj" class="form-control" id="cnpj" placeholder="CNPJ" onkeypress="mascara(this, '##.###.###/####-##')" maxlength="18" required>
          </div>
           <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Rua</label>
            <input type="text" name="rua" class="form-control" id="rua" placeholder="Rua" required>
          </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Bairro</label>
            <input type="text" name="bairro" class="form-control" id="bairro" placeholder="Bairro" required>
          </div>
           <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Cidade</label>
            <input type="text" name="cidade" class="form-control" id="cidade" placeholder="Cidade" required>
          </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Estado</label>
            <input type="text" name="estado" class="form-control" id="estado" placeholder="Estado" required>
          </div>
          <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Numero</label>
            <input type="text" name="numero" class="form-control" id="numero" placeholder="Numero" required>
          </div>           
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control" id="telefone" placeholder="Telefone" required>
          </div>
          <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Email</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="Email" required>
          </div>
        </div>  
        <input name="idusu" type="hidden" class="form-control" id="id-curso" value=""> 
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
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
        <form method="POST" action="apagar-forn.php">                          
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





<div class="modal fade bd-example-modal-lg" id="modalcadastrar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">   
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastro de Funcionario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="container">
       <form method="POST" action="cadastro-forn.php">
       <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Razao Social</label>
            <input type="text" name="razaosocial" class="form-control" id="razaosocial" placeholder="Razao Social" required>
          </div>
           <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Nome Fantasia</label>
            <input type="text" name="nomefantasia" class="form-control" id="nomefantasia" placeholder="Nome Fantasia" required>
          </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">CNPJ</label>
            <input type="text" name="cnpj" class="form-control" id="cnpj" placeholder="CNPJ" onkeypress="mascara(this, '##.###.###/####-##')" maxlength="18" required>
          </div>
           <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Rua</label>
            <input type="text" name="rua" class="form-control" id="rua" placeholder="Rua" required>
          </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Bairro</label>
            <input type="text" name="bairro" class="form-control" id="bairro" placeholder="Bairro" required>
          </div>
           <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Cidade</label>
            <input type="text" name="cidade" class="form-control" id="cidade" placeholder="Cidade" required>
          </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Estado</label>
            <input type="text" name="estado" class="form-control" id="estado" placeholder="Estado" required>
          </div>
          <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Numero</label>
            <input type="text" name="numero" class="form-control" id="numero" placeholder="Numero" required>
          </div>           
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control" id="telefone" placeholder="Telefone" required>
          </div>
          <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Email</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="Email" required>
          </div>
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
<!-- Fim modal Apagar
 Js Alterar Modal  -->
<script type="text/javascript">
  $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Botão que acionou o modal
  var recipient = button.data('whatever') // Extrai informação dos atributos data-*
  var recipientid = button.data('whateverid')
  var recipientrazao = button.data('whateverrazao')
  var recipientnome = button.data('whatevernome')
  var recipientcnpj = button.data('whatevercnpj')
  var recipientrua = button.data('whateverrua')
  var recipientbairro = button.data('whateverbairro')
  var recipientcidade = button.data('whatevercidade')
  var recipientestado = button.data('whateverestado')
  var recipientnumero = button.data('whatevernumero')
  var recipientel = button.data('whatevertel')
  var recipienemail = button.data('whateveremail')

  // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
  // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
  var modal = $(this)
  modal.find('.modal-title').text('Alterar usario de: ' + recipient)
  //modal.find('.modal-body input').val(recipient)
  modal.find('#id-curso').val(recipientid)
  modal.find('#razaosocial').val(recipientrazao)
  modal.find('#nomefantasia').val(recipientnome)
  modal.find('#cnpj').val(recipientcnpj)
  modal.find('#rua').val(recipientrua)
  modal.find('#bairro').val(recipientbairro)
  modal.find('#cidade').val(recipientcidade)
  modal.find('#estado').val(recipientestado)
  modal.find('#numero').val(recipientnumero)
  modal.find('#telefone').val(recipientel)
  modal.find('#email').val(recipienemail)
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
