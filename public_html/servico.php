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
    	 <div class="row">
        <div class="col-md-9">
          <h2>Serviço</h2>
        </div>
        <div class="col-md-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalcadastrar">Cadastar Serviço</button>
      </div>
      </div>
      <?php
    	$sql = $pdo->prepare("SELECT idPeca, descricao, preco FROM pecas");


                       $sql->execute();
                       if($sql->rowCount() > 0 ){
                       	?>
        <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Codigo</th>
              <th>Descricao</th>
              <th>Preco</th>              
              <th>Inserir no EsToKi</th>
            </tr>
          </thead>
          <tbody>
           <?php
            foreach($sql->fetchAll() as $dados_func){
                        		?>   		
            <tr>
              <td><?php echo $dados_func['idPeca']; ?></td>
              <td><?php echo $dados_func['descricao']; ?></td>
              <td><?php echo $dados_func['preco'] ?></td>                       
     			    <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $dados_func['descricao']; ?>" data-whateverid="<?php echo $dados_func['idPeca']; ?>">Inserir</button>
  				    </td>
            </tr>
          
        <?php 
                        }
                    }      
      ?>
      </tbody>
        </table>
        <?php var_dump($_POST);  
        
        ?>
      </div>
      <!-- Comeco modal Serviço --->
      <div class="modal fade bd-example-modal-lg" id="modalcadastrar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">   
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastro de Serviço</h5>
        <hr>
        <?php 

        $sql = $pdo->prepare("SELECT idPeca, descricao FROM pecas");
        $sql->execute();  

        $sql2 = $pdo->prepare("SELECT idCliente, nome FROM cliente");
        $sql2->execute();       
              ?>
 
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="container">
       <form method="POST" action="servico-sql.php">
       <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Descrição</label>
            <input type="text" name="descricao" class="form-control" id="descricao" placeholder="Descrição" >
          </div>
           <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Mão de Obra</label>
            <input type="text" name="maodeobra" class="form-control" id="maodeobra" placeholder="Mão de Obra" >
          </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Total</label>
            <input type="text" name="total" class="form-control" id="total" placeholder="Total" >
          </div>
           <div class="form-group col-md-6">
            <label for="recipient-name" class="col-form-label">Data</label>
            <input type="date" name="date" class="form-control" id="date" >
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="inputState">Cliente</label>   
             <select id="inputState" class="form-control" name="cliente">
             <option selected>Escolha...</option>                        
              <?php
                foreach ($sql2->fetchAll() as $dados2) { ?>
              <option value="<?php echo $dados2['idCliente'] ?>"><?php echo $dados2['nome']; ?></option>;
              <?php } 
              ?>
            </select>
          </div>
           <div class="form-group col-md-6">
            <label for="inputState">Peça</label>
             <select id="inputState" class="form-control" name="peca">
              <option selected>Escolha...</option>
             <?php
                foreach ($sql->fetchAll() as $dados) { ?>
              <option value="<?php echo $dados['idPeca'] ?>"><?php echo $dados['descricao']; ?></option>;
              <?php } 
              ?>
            </select>
          </div>
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

<!-- Fim modal Cadastrar Serviço --->
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Inserir no estoque a peça: </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="entrada-peca-sql.php">
       
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Quantidade</label>
            <input type="text" name="quantidade" class="form-control" id="recipient-name" placeholder="Quantidade">
          </div>         
             <div class="form-group">            
           <input name="idusu" type="hidden" class="form-control" id="id-curso" value="">
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Inserir</button>
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
  modal.find('.modal-title').text('Inserir no estoque a peça: ' + recipient)
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
