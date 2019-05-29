<?php
require_once '../Controller/CategoriaController.php';
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Free Bootstrap Admin Template : Binary Admin</title>
        <!-- BOOTSTRAP STYLES-->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLES-->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
        <link href="assets/css/custom.css" rel="stylesheet" />
        <!-- GOOGLE FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- METISMENU SCRIPTS -->
        <script src="assets/js/jquery.metisMenu.js"></script>
        <!-- CUSTOM SCRIPTS -->
        <script src="assets/js/custom.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <?php
            include "_topo.php";
            include "_menu.php";

            if(!isset($_SESSION['cod_usuario'])){
                echo '<script>window.location.href="login.php"</script>';
                exit();
            }
            
            $nome_categoria = '';
            $cod_categoria = '';
            $cod_usuario = $_SESSION['cod_usuario'];



            if (isset($_POST['btn__Gravar'])) {

                $nome_categoria = $_POST['nome_categoria'];
                $cod_categoria = $_POST ['codigo'];

                $objcontroller = new CategoriaController();
                if ($cod_categoria == '') {
                    $ret = $objcontroller->InserirCategoria($nome_categoria, $cod_usuario);
                } else {
                    $ret = $objcontroller->AlterarCategoria($nome_categoria, $cod_categoria);
                }
            }
            if (isset($_POST['btn_Alterar'])) {

                $nome_categoria = $_POST['nome_categoria_alt'];
                $cod_categoria = $_POST['cod_categoria_alt'];
            }

            $objcontroller = new CategoriaController();
            $listaCategoria = $objcontroller->ConsultarCategoria($cod_usuario);
            ?>
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if (isset($ret)) {

                                if ($ret == 0) {
                                    echo '<div class="alert alert-warning">Preencher campos obrigatórios</div>';
                                } else if ($ret == -1) {
                                    echo '<div class="alert alert-danger">Ocorreu um erro tente mais tarde.</div>';
                                } else if ($ret == 1) {
                                    echo '<div class="alert alert-success">Dados Gravados com sucesso.</div>';
                                    $nome_categoria - "";
                                }
                            }
                            ?>
                            <h2>Cadastrar Categoria</h2>   
                            <h5>Aqui você pode cadastrar todas as categorias do sistemas</h5>
                            <form action="categoria.php" method="post">
                                <input type="hidden" name="codigo" value="<?= $cod_categoria ?>">
                                    <div class="form-group">
                                        <label>Categoria</label>
                                        <input type="text" id="nome_categoria" name="nome_categoria" class="form-control" maxlength="45" placeholder="Digite o nome"value="<?= $nome_categoria ?>" /> 
                                    </div>
                                    <button type="submit" class="btn btn-primary"id="btn__Gravar" name= "btn__Gravar">Gravar</button> 
                            </form>
                            <hr>
                                <?php if (count($listaCategoria) > 0) { ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- Advanced Tables -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    Categorias Cadastradas
                                                </div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nome</th>
                                                                    <th>Ação</th>

                                                            </thead>
                                                            <tbody>
                                                                <?php for ($i = 0; $i < count($listaCategoria); $i++) { ?>
                                                                    <form action="categoria.php"method="post">

                                                                        <tr class="odd gradeX">
                                                                            <td><?php echo $listaCategoria[$i]['nome_categoria'] ?> </td>
                                                                            <td>
                                                                                <input type="hidden" name="cod_categoria_alt" value="<?php echo $listaCategoria[$i]['cod_categoria'] ?>">
                                                                                    <input type="hidden" name="nome_categoria_alt" value="<?php echo $listaCategoria[$i]['nome_categoria'] ?>">
                                                                                        <button type="submit" class="btn btn-default"id="btn_Alterar" name= "btn_Alterar">Alterar</button>
                                                                                        </td>
                                                                                        </tr>
                                                                                        </form>
                                                                                    <?php } ?>
                                                                                    </tbody>
                                                                                    </table>
                                                                                    </div>

                                                                                    </div>
                                                                                    </div>
                                                                                    <!--End Advanced Tables -->
                                                                                    </div>
                                                                                    </div>
                                                                                <?php } ?>
                                                                                </div>
                                                                                </div>
                                                                                <!-- /. ROW  -->
                                                                                <hr />

                                                                                </div>
                                                                                <!-- /. PAGE INNER  -->
                                                                                </div>
                                                                                <!-- /. PAGE WRAPPER  -->
                                                                                </div>
                                                                                <script>
                                                                                    $("#btn__Gravar").click(function () {

                                                                                        if ($("#nome_categoria").val().trim() == "") {
                                                                                            alert("Prencher o campo NOME CATEGORIA");
                                                                                            return false;
                                                                                        }

                                                                                    })

                                                                                </script>
                                                                                </body>
                                                                                </html>

