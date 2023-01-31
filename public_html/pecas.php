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
    <style>
    #btnEditor {
        border: none;
        outline: none !important;
    }

    #btnExcluir {
        border: none;
        outline: none !important;
    }
    </style>
</head>

<body>
    <?php
      require 'menu.php';
    ?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

        <br />
        <div class="col-lg-12" style="display:flex">
            <div class="col-lg-9">
                <h2>Peças</h2>
            </div>
            <div class="col-lg-3">
                <button style="float:right" type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#modalCadastrar">Cadastar Produtos</button>
            </div>
        </div>
        <?php
      $sql = $pdo->prepare("SELECT idPeca, descricao, preco, fkFornecedor, fornecedor.nomeFantasia FROM pecas INNER JOIN Fornecedor ON fornecedor.idFornecedor = pecas.fkFornecedor");
                       $sql->execute();
                       if($sql->rowCount() > 0 ){
                        ?>
        <div class="table-responsive">
            <table id="crudPeca" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Fornecedor</th>
                        <th style="text-align:right" scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
            foreach($sql->fetchAll() as $dados_pecas){
                            ?>
                    <tr>
                        <td><?php echo $dados_pecas['idPeca']; ?></td>
                        <td><?php echo $dados_pecas['descricao']; ?></td>
                        <td><?php echo $dados_pecas['preco']; ?></td>
                        <td><?php echo $dados_pecas['nomeFantasia']; ?></td>
                        <td style="float:right">
                        <input type="hidden" id="fkForn" value="<?php echo $dados_pecas['fkFornecedor']; ?>"/>
                            <button type="button" class="btn" data-toggle="modal" data-target="#modalAtualizar"
                                data-whatever="<?php echo $dados_pecas['descricao']; ?>"
                                data-whateverpreco="<?php echo $dados_pecas['preco'];?>"
                                data-whatevernome="<?php echo $dados_pecas['nomeFantasia']; ?>"
                                data-whateverid="<?php echo $dados_pecas['idPeca']; ?>"><i style="color:black"
                                    class="fas fa-pencil-alt"></i></button>
                            <button id="btnExcluir" type="button" value="<?php echo $dados_pecas['idPeca']; ?>"
                                class="btn" data-toggle="modal" data-target="#modalExcluir"><i style="color:black"
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>

                    <?php 
                                }
                            }      
              ?>
                </tbody>
            </table>
        </div>

        <!-- Modal Cadastrar-->
        <div class="modal fade" id="modalCadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastro de Peças</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class=" col-md"><br><br>
                                    <form method="post" action="cadastro-peca.php">
                                        <div class="form-group">
                                            <input type="text" name="desc" class="form-control" id="desc"
                                                placeholder="Descrição">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="prec" class="form-control" id="prec"
                                                placeholder="Preço">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="forn" class="form-control" id="forn"
                                                placeholder="Código Fornecedor">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-primary" data-target="#button">Salvar
                                                mudanças</button>
                                        </div>
                                    </form>
                                </div><!-- fecha col1 -->
                            </div> <!-- linha 01 --><br>
                        </div>
                        <!--container -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Excluir-->
        <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Exclusão</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>Você deseja mesmo excluir este funcionário?</label>
                    </div>
                    <div class="modal-footer">
                        <form class="form-horizontal" action="delete.php" method="post">
                            <input id="dadosTable" type="hidden" name="id" value="" />
                            <div class="form actions">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-danger" data-target="#button">Excluir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Atualizar-->
        <div class="modal fade" id="modalAtualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Atualizar Informações</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class=" col-md"><br><br>
                                    <form method="POST" action="atualizar.php">
                                   
                                        <input class="inv" type="hidden" name="id" id="dados"
                                            value="<?php echo $_GET['idAt'] ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Descrição"
                                                id="descricao" value="<?php echo $data['descricao']?>" name="descricao">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Preço" id="preco"
                                                value="<?php echo $data['preco']?>" name="preco">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control disable" placeholder="Código Forncecedor"
                                                id="fornecedor" value="<?php echo $data['fkFornecedor']?>"
                                                name="fkFornecedor">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Fechar</button>
                                            <button type="submit" id="clickAlterar" class="btn btn-primary" data-target="#button">Salvar
                                                mudanças</button>
                                        </div>
                                    </form>
                                </div><!-- fecha col1 -->
                            </div> <!-- linha 01 --><br>
                        </div>
                        <!--container -->
                    </div>
                </div>
            </div>
        </div>
    </main>
    </div>
    </div>
    <script type="text/javascript">
    $(function() {
        $('#crudPeca').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            },
            columnDefs: [{
                    targets: [0, 1, 2, 3, 4],
                    className: 'dt-center'
                },
                {
                    targets: [4],
                    orderable: false
                },
                {
                    data: 'price',
                    render: $.fn.dataTable.render.number('.', ',', 2, 'R$ '),
                    targets: 2
                }
            ],

            infoCallback: function(settings, start, end, max, total, pre) {
                return `Total de ${end} registro(s)`;
            },
            order: [1, 'asc'],
            info: true,
            paging: false,
            autoWidth: true,
            scrollX: true,
            select: true,
            searching: true
        });

        $('#modalAtualizar').on('show.bs.modal', function(event) {
            debugger;
            var button = $(event.relatedTarget); // Botão que acionou o modal
            var dsProduto = button.data('whatever'); // Extrai informação dos atributos data-*
            var preco = button.data('whateverpreco');
            var forn = button.data('whatevernome');
            var idPeca = button.data('whateverid');
            // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
            // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
            var modal = $(this);
            modal.find('#descricao').val(dsProduto);
            modal.find('#preco').val(preco);
            modal.find('#fornecedor').val(forn);
            modal.find('#dados').val(idPeca);
        });
        $('#btnExcluir').click(function() {
            debugger;
            var id = $('#btnExcluir').val();
            $('#dadosTable').val(id);
        });

        $('#clickAlterar').click(function() {
            debugger;
            var id = $('#fkForn').val();
            $('#fornecedor').val(id);
        });
    });
    </script>
</body>

</html>