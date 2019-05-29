<?php
require_once '../Controller/MovimentoController.php';
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
        <script src="assets/js/jquery.mask.min.js" type="text/javascript"></script>
        <script src="assets/js/mask.js" type="text/javascript"></script>
        <script src="assets/js/custom.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <?php
            include "_topo.php";
            include "_menu.php";

            if (!isset($_SESSION['cod_usuario'])) {
                echo '<script>window.location.href="login.php"</script>';
                exit();
            }

            $cod_usuario = $_SESSION['cod_usuario'];

            $tipo_movimento = '';
            $data_inicial = '';
            $data_final = '';
            $lista_movimento = '';

            if (isset($_POST['btn__procurar'])) {

                $tipo_movimento = $_POST['tipo_movimento'];
                $data_inicial = trim($_POST['data_inicial']);
                $data_final = trim($_POST['data_final']);

                $objcontroller = new MovimentoController();
                $lista_movimento = $objcontroller->ConsultarMovimento($tipo_movimento, $data_inicial, $data_final, $cod_usuario);
            }
            ?>
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if (isset($lista_movimento)) {

                                if ($lista_movimento === 0) {
                                    echo '<div class="alert alert-warning">Preencher campos obrigatórios</div>';
                                }
                                
                                }
                            ?>
                            <h2>Consultar Movimento</h2>   
                            <h5>Aqui você pode realizar suas entradas e saídas</h5>
                            <form action="consultar_movimento.php" method="post">

                                <div class="form-group">
                                    <label>Tipo Movimento</label>
                                    <select id="tipo_movimento" name="tipo_movimento" class="form-control" >
                                        <option value="-1" selected="selected">Todos</option>
                                        <option value="1">Entrada</option>
                                        <option value="2">Saída</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Data Inicial</label>
                                    <input type="text" id="data_inicial" name="data_inicial" class="form-control date" placeholder="DD/MM/AAAA" />
                                </div>
                                <div class="form-group">
                                    <label>Data Final</label>
                                    <input type="text" id="data_final" name="data_final" class="form-control date" placeholder="DD/MM/AAAA" />
                                </div>

                                <button type="submit" class="btn btn-primary"id="btn__procurar" name= "btn__procurar">Procurar</button> 
                            </form>
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
                    <?php } ?>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <script>
          
            $("#btn__procurar").click(function () {
          
                if ($("#data_inicial").val().trim() == "") {
                    alert("Digite a data inicial");
                    return false;
            }
                if ($("#data_final").val().trim() == "") {
                    alert("Digite a data final");
                    return false;   
                }
            });
           
        </script>
    </body>
</html>

