<?php
require_once '../Controller/EmpresaController.php';
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
            $nome_empresa = '';
            $endereco_empresa = '';
            $telefone_empresa = '';
            $cod_usuario = $_SESSION['cod_usuario'];
            $cod_empresa = '';
            if (!isset($_SESSION['cod_usuario'])) {
                echo '<script>window.location.href="login.php"</script>';
                exit();
            }
            if (isset($_POST['btn_Gravar'])) {
                $nome_empresa = $_POST['nome_empresa'];
                $endereco_empresa = $_POST['endereco_empresa'];
                $telefone_empresa = $_POST['telefone_empresa'];
                $cod_empresa = $_POST ['codigo'];

                $objcontroller = new EmpresaController();
                if ($cod_empresa == '') {
                    $ret = $objcontroller->InserirEmpresa($nome_empresa, $endereco_empresa, $telefone_empresa, $cod_usuario);
                } else {
                    $ret = $objcontroller->AlterarEmpresa($nome_empresa, $endereco_empresa, $telefone_empresa, $cod_empresa);
                }
            }

            if (isset($_POST['btn_Alterar'])) {

                $nome_empresa = $_POST['nome_empresa_alt'];
                $endereco_empresa = $_POST['endereco_empresa_alt'];
                $telefone_empresa = $_POST['telefone_empresa_alt'];
                $cod_empresa = $_POST['cod_empresa_alt'];
            }

            $objcontroller = new EmpresaController();
            $listaEmpresa = $objcontroller->ConsultarEmpresa($cod_usuario);
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
                                } else if ($ret == -2) {
                                    echo '<div class="alert alert-warning">Preencher o NOME DA EMPRESA</div>';
                                } else if ($ret == -3) {
                                    echo '<div class="alert alert-warning"Preencher o ENDEREÇO DA EMPRESA</div>';
                                } else if ($ret == -4) {
                                    echo '<div class="alert alert-warning">Preencher TELEFONE DA EMPRESA</div>';
                                } else if ($ret == 1) {
                                    echo '<div class="alert alert-success">Dados Gravados com sucesso.</div>';
                                    $nome_empresa = "";
                                    $endereco_empresa = "";
                                    $telefone_empresa = "";
                                }
                            }
                            ?> 
                            <h2>Cadastrar Empresa</h2>   
                            <h5>Aqui você pode cadastrar todas as empresas</h5>
                            <form action="empresa.php" method="post">
                                <input type="hidden" name="codigo" value="<?= $cod_empresa ?>">

                                    <div class="form-group">
                                        <label>Empresa</label>
                                        <input type="text" id="nome_empresa" name="nome_empresa"     class="form-control" maxlength="45" placeholder="Digite o nome" value="<?= $nome_empresa ?>" />        
                                    </div>
                                    <div class="form-group">
                                        <label>Endereço</label>
                                        <input type="text" id="endereco_empresa" name="endereco_empresa"     class="form-control" maxlength="60" placeholder="Digite o endereço"value="<?= $endereco_empresa ?>" />        
                                    </div>
                                    <div class="form-group">
                                        <label>Telefone</label>
                                        <input type="text" id="telefone_empresa" name="telefone_empresa"     class="form-control" maxlength="11" placeholder="Digite o telefone"value="<?= $telefone_empresa ?>" />        
                                    </div>
                                    <button type="submit" class="btn btn-primary" id="btn_Gravar" name= "btn_Gravar">Gravar</button> 
                            </form>
                            <hr
                            <?php if (count($listaEmpresa) > 0) { ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- Advanced Tables -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    Empresas Cadastradas
                                                </div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nome</th>
                                                                    <th>Endereço</th>
                                                                    <th>Telefone</th>
                                                                    <th>Ação</th>
                                                            </thead>
                                                            <tbody>
                                                                <?php for ($i = 0; $i < count($listaEmpresa); $i++) { ?>
                                                                    <form action="empresa.php"method="post">

                                                                        <tr class="odd gradeX">
                                                                            <td><?php echo $listaEmpresa[$i] ['nome_empresa'] ?> </td>
                                                                            <td><?php echo $listaEmpresa[$i] ['endereco_empresa'] ?> </td>
                                                                            <td><?php echo $listaEmpresa[$i] ['telefone_empresa'] ?> </td>
                                                                            <td>
                                                                                <input type="hidden" name="cod_empresa_alt" value="<?php echo $listaEmpresa[$i]['cod_empresa'] ?>">
                                                                                    <input type="hidden" name="nome_empresa_alt" value="<?php echo $listaEmpresa[$i]['nome_empresa'] ?>">
                                                                                        <input type="hidden" name="endereco_empresa_alt" value="<?php echo $listaEmpresa[$i]['endereco_empresa'] ?>">
                                                                                            <input type="hidden" name="telefone_empresa_alt" value="<?php echo $listaEmpresa[$i]['telefone_empresa'] ?>">
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
                                                                                            $("#btn_Gravar").click(function () {

                                                                                                if ($("#nome_empresa").val().trim() == "") {
                                                                                                    alert("Prencher o campo NOME DA EMPRESA");
                                                                                                    return false;
                                                                                                }
                                                                                                if ($("#endereco_empresa").val().trim() == "") {
                                                                                                    alert("Prencher o campo ENDEREÇO EMPRESA");
                                                                                                    return false;
                                                                                                }
                                                                                                if ($("#telefone_empresa").val().trim() == "") {
                                                                                                    alert("Prencher o campo TELEFONE EMPRESA");
                                                                                                    return false;
                                                                                                }

                                                                                            })
                                                                                        </script>


                                                                                        </body>
                                                                                        </html>
