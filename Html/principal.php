<?php
require_once '../Controller/MovimentoController.php';

//session_start();
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
            require_once "_topo.php";
            require_once "_menu.php";
            if (!isset($_SESSION['cod_usuario'])) {
                echo '<script>window.location.href="login.php"</script>';
                exit();
            }
            $cod_usuario = $_SESSION['cod_usuario'];

            $objtcontroller = new MovimentoController();

            $lista_movimento = $objtcontroller->UltimosMovimentos($cod_usuario);
            ?>
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Ultimos Movimentos</h2>   
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <?php if (count($lista_movimento) > 0 && $lista_movimento != '') { ?>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Advanced Tables -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Movimentos Encontrados
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th>Tipo</th>
                                                        <th>Data</th>
                                                        <th>Valor</th>
                                                        <th>Observação</th>
                                                        <th>Categoria</th>
                                                        <th>Empresa</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <?php for ($i = 0; $i < count($lista_movimento); $i++) { ?>


                                                        <tr class="odd gradeX">
                                                            <td><?php echo ($lista_movimento[$i]['tipo_movimento'] == 1 ? 'Entrada' : 'Saída') ?> </td>
                                                            <td><?php echo explode('-', $lista_movimento[$i]['data_movimento'])[2] . '/' . explode('-', $lista_movimento[$i]['data_movimento'])[1] . '/' . explode('-', $lista_movimento[$i]['data_movimento'])[0] ?> </td>
                                                            <td>R$ <?php echo $lista_movimento[$i]['valor_movimento'] ?> </td>
                                                            <td><?php echo $lista_movimento[$i]['obs_movimento'] ?> </td>
                                                            <td><?php echo $lista_movimento[$i]['nome_categoria'] ?> </td>
                                                            <td><?php echo $lista_movimento[$i]['nome_empresa'] ?> </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!--End Advanced Tables -->
                            </div>
                        </div>
                        <?php
                    } else {
                        echo '<center> Não existe nenhum movimento. Caso queira realizar um movimento, <a href="movimento.php">clique aqui</a></center>';
                    }
                    ?>

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

            });
            
        </script>


    </body>
</html>


/* 
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

