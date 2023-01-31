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
          <h2>Funcionarios</h2>
        </div>
        <div class="col-md-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalcadastrar">Cadastar Funcionario</button>
      </div>
      </div>
      </div>
      <?php
      $sql = $pdo->prepare("SELECT * FROM funcionario ");
                       $sql->execute();
                       if($sql->rowCount() > 0 ){
                        ?>
        <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Email</th>
              <th>CPF</th>
              <th>RG</th>
              <th>Contato</th>
              <th>Endereco</th>
              <th>Salario</th>
              <th>Alterar</th>
              <th>Excluir</th>
            </tr>
          </thead>
          <tbody>
           <?php
            foreach($sql->fetchAll() as $dados_func){
                            ?>      
            <tr>
              <td><?php echo $dados_func['nome']; ?></td>
              <td><?php echo $dados_func['email']; ?></td>
              <td><?php echo $dados_func['cpf']; ?></td>
              <td><?php echo $dados_func['rg']; ?></td>
              <td><?php echo $dados_func['telefone']." / ".$dados_func['celular']; ?></td>
              <td><?php echo $dados_func['rua'].", ".$dados_func['bairro'].", ".$dados_func['cidade']; ?></td>
              <td><?php echo $dados_func['salario']; ?></td>
              <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $dados_func['nome']; ?>" data-whateverid="<?php echo $dados_func['matricula']; ?>" data-whateveremail="<?php echo $dados_func['email']; ?>" data-whatevercpf="<?php echo $dados_func['cpf']; ?>" data-whateverrg="<?php echo $dados_func['rg']; ?>" data-whatevertel="<?php echo $dados_func['telefone']; ?>" data-whatevercel="<?php echo $dados_func['celular']; ?>" data-whateverrua="<?php echo $dados_func['rua']; ?>" data-whateverbairro="<?php echo $dados_func['bairro']; ?>" data-whatevercidade="<?php echo $dados_func['cidade']; ?>" data-whateversalario="<?php echo $dados_func['salario']; ?>" data-whatevercargo="<?php echo $dados_func['cargo']; ?>">Alterar</button></td>

              <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#apagarmodal" data-whatevernome="<?php echo $dados_func['nome']; ?>" data-whateverid2="<?php echo $dados_func['matricula']; ?>">Excluir</button>
              </td>
              
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
        <h5 class="modal-title" id="exampleModalLabel">Alterar usario de: </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="container">
       <form method="POST" action="alterar-func.php">
       <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Nome</label>
            <input type="text" name="nome" class="form-control" id="nome" placeholder="Novo Login">
          </div>
           <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">CPF</label>
            <input type="text" name="cpf" class="form-control" id="cpf" onkeypress="mascara(this, '###.###.###-##')" maxlength="14">
          </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">RG</label>
            <input type="text" name="rg" class="form-control" id="rg" onkeypress="mascara(this, '##.###.###-#')" maxlength="12">
          </div>
           <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Celular</label>
            <input type="text" name="cel" class="form-control" id="cel" onkeypress="mascara(this, '## #####-####')" maxlength="13">
          </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Telefone</label>
            <input type="text" name="tel" class="form-control" id="tel" onkeypress="mascara(this, '## ####-####')" maxlength="12">
          </div>
           <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Email</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="Novo Login">
          </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Rua</label>
            <input type="text" name="rua" class="form-control" id="rua" placeholder="Novo Login">
          </div>
           <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Bairro</label>
            <input type="text" name="bairro" class="form-control" id="bairro" placeholder="Novo Login">
          </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Cidade</label>
            <input type="text" name="cidade" class="form-control" id="cidade" placeholder="Novo Login">
          </div>
           <div class="form-group col-md-6">
            <label for="inputState">Função</label>
              <select name="cargo" class="form-control" required>
                <option value="">Escolha</option>
                <option value="0">Dono</option>
                <option value="1">Funcionario</option>                    
              </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Salario</label>
            <input type="text" name="salario" class="form-control" id="salario" placeholder="Novo Login">
          </div>
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

 Modal Cadastrar Funcionario -->
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
       <form method="POST" action="cadastro-func-sql.php">
       <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Nome</label>
            <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome" required>
          </div>
           <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">CPF</label>
            <input type="text" name="cpf" class="form-control" id="cpf" placeholder="CPF" onkeypress="mascara(this, '###.###.###-##')" maxlength="14" required>
          </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">RG</label>
            <input type="text" name="rg" class="form-control" id="rg" placeholder="RG" onkeypress="mascara(this, '##.###.###-#')" maxlength="12" required>
          </div>
           <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Celular</label>
            <input type="text" name="cel" class="form-control" id="cel" placeholder="Celular" onkeypress="mascara(this, '## #####-####')" maxlength="13" required>
          </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Telefone</label>
            <input type="text" name="tel" class="form-control" id="tel" placeholder="Telefone" onkeypress="mascara(this, '## ####-####')" maxlength="12" required>
          </div>
           <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Email</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="Email" required>
          </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Rua</label>
            <input type="text" name="rua" class="form-control" id="rua" placeholder="Rua" required>
          </div>
           <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Bairro</label>
            <input type="text" name="bairro" class="form-control" id="bairro" placeholder="Bairro" required>
          </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Cidade</label>
            <input type="text" name="cidade" class="form-control" id="cidade" placeholder="Cidade" required>
          </div>
           <div class="form-group col-md-6">
            <label for="inputState">Função</label>
              <select name="cargo" class="form-control" required>
                <option value="">Escolha</option>
                <option value="0">Dono</option>
                <option value="1">Funcionario</option>                    
              </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Salario</label>
            <input type="number" name="salario" class="form-control" id="salario" placeholder="Salario" required>
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
<!-- Fim modal Cadastrar 

 Modal Apagar  -->
<div class="modal fade" id="apagarmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apagar Funcionario de: </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="alert alert-danger" role="alert">
      <center>Voce deseja realmente  apagar o Funcionario?</center>
      </div>
      <div class="modal-body">
        <form method="POST" action="excluir-func.php">                          
           <input name="idusu" type="hidden" class="form-control" id="id-curso" value="">                 
         <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Sim</button>
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
    debugger;
  var button = $(event.relatedTarget) // Botão que acionou o modal
  var recipient = button.data('whatever') // Extrai informação dos atributos data-*
  var recipientid = button.data('whateverid')
  var recipientcpf = button.data('whatevercpf')
  var recipientrg = button.data('whateverrg')
  var recipientcel = button.data('whatevercel')
  var recipienttel = button.data('whatevertel')
  var recipientemail = button.data('whateveremail')
  var recipientsalario = button.data('whateversalario')
  var recipientrua = button.data('whateverrua')
  var recipientbairro = button.data('whateverbairro')
  var recipientcidade = button.data('whatevercidade')
  var recipientcargo = button.data('whatevercargo')
  // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
  // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
  var modal = $(this)
  modal.find('.modal-title').text('Alterar o Funcionario: ' + recipient)
  modal.find('#nome').val(recipient)
  modal.find('#id-curso').val(recipientid)
  modal.find('#cpf').val(recipientcpf)
  modal.find('#rg').val(recipientrg)
  modal.find('#cel').val(recipientcel)
  modal.find('#tel').val(recipienttel)
  modal.find('#email').val(recipientemail)
  modal.find('#salario').val(recipientsalario)
  modal.find('#rua').val(recipientrua)
  modal.find('#bairro').val(recipientbairro)
  modal.find('#cidade').val(recipientcidade)
  modal.find('#cargo').val(recipientcargo)
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
  modal.find('.modal-title').text('Apagar o Funcionario: ' + recipient)
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
