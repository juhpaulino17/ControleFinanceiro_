<?php
require_once '../Controller/MovimentoController.php';
require_once '../Controller/CategoriaController.php';
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
     
        <script src="assets/js/jquery.mask.min.js" type="text/javascript"></script>
        <script src="assets/js/mask.js" type="text/javascript"></script>
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
            $cod_usuario = $_SESSION['cod_usuario'];
            ;
            $ret = '';

            if (isset($_POST['btn__Gravar'])) {

                $tipo_movimento = $_POST ['tipo_movimento'];
                $cod_categoria = $_POST ['cod_categoria'];
                $cod_empresa = $_POST ['cod_empresa'];
                $data_movimento = $_POST ['data_movimento'];
                $valor_movimento = $_POST ['valor_movimento'];
                $obs_movimento = $_POST ['obs_movimento'];

                $objcontroller = new MovimentoController();
                $ret = $objcontroller->RealizarMovimento($tipo_movimento, $data_movimento, $valor_movimento, $obs_movimento, $cod_usuario, $cod_categoria, $cod_empresa);
            }

            $objcontroller = new CategoriaController();
            $listaCategoria = $objcontroller->ConsultarCategoria($cod_usuario);
            $objtcontroller = new EmpresaController();
            $listaEmpresa = $objtcontroller->ConsultarEmpresa($cod_usuario)
            ?>
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if (isset($ret)) {

                                if ($ret === 0) {
                                    echo '<div class="alert alert-warning">Preencher campos obrigatórios</div>';
                                } else if ($ret === -1) {
                                    echo '<div class="alert alert-danger">Ocorreu um erro tente mais tarde.</div>';
                                } else if ($ret === 1) {
                                    echo '<div class="alert alert-success">Dados Gravados com sucesso.</div>';
                                }
                            }
                            ?>
                            <h2>Realizar Movimento</h2>   
                            <h5>Aqui você pode realizar suas entradas e saídas</h5>
                            <form action="movimento.php" method="post">

                                <div class="form-group">
                                    <label>Tipo Movimento</label>
                                    <select id="tipo_movimento" name="tipo_movimento" class="form-control" >
                                        <option value=""selected="selected">Selecione</option>
                                        <option value="1">Entrada</option>
                                        <option value="2">Saída</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Categoria</label>
                                    <select id="cod_categoria" name="cod_categoria" class="form-control" >
                                        <?php if (count($listaCategoria) > 0) { ?>
                                            <option value=""selected="selected">Selecione</option>

                                            <?php for ($i = 0; $i < count($listaCategoria); $i++) { ?>

                                                <option value="<?php echo $listaCategoria[$i]['cod_categoria'] ?>"><?php echo $listaCategoria[$i]['nome_categoria'] ?></option>

                                            <?php } ?>
                                        <?php } else { ?>
                                            <option value=""selected="selected">Não tem categorias cadastradas</option>
                                        <?php } ?> 

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Empresa</label>
                                    <select id="cod_empresa" name="cod_empresa" class="form-control" >
                                        <?php if (count($listaEmpresa) > 0) { ?>
                                            <option value=""selected="selected">Selecione</option>

                                            <?php for ($i = 0; $i < count($listaEmpresa); $i++) { ?>

                                                <option value="<?php echo $listaEmpresa[$i]['cod_empresa'] ?>"><?php echo $listaEmpresa[$i]['nome_empresa'] ?></option>

                                            <?php } ?>
                                        <?php } else { ?>
                                            <option value=""selected="selected">Não tem empresas cadastradas</option>
                                        <?php } ?> 

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Data Movimento</label>
                                    <input type="text" id="data_movimento" name="data_movimento" class="form-control date" placeholder="DD/MM/AAAA" /> 
                                </div>
                                <div class="form-group">
                                    <label>Valor Movimento</label>
                                    <input type="text" id="valor_movimento" name="valor_movimento" class="form-control money" placeholder="Digite o valor do movimento"/> 

                                </div>
                                <div class="form-group">
                                    <label>Observação Movimento</label>
                                    <input type="text" id="obs_movimento" name="obs_movimento" class="form-control" placeholder="Digite a observação" maxlength="100"/> 

                                </div>
                                <button type="submit" class="btn btn-primary"id="btn__Gravar" name= "btn__Gravar">Gravar</button> 
                            </form>
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

                if ($("#tipo_movimento").val().trim() == "") {
                    alert("Selecionar o tipo do movimento");
                    return false;
                }
                if ($("#tipo_movimento").val().trim() == "") {
                    alert("Selecionar a categoria do movimento");
                    return false;
                }
                if ($("#tipo_movimento").val().trim() == "") {
                    alert("Prencher o campo data movimento");
                    return false;
                }
                if ($("#valor_movimento").val().trim() == "") {
                    alert("Prencher o campo data movimento");
                    return false;
                    
                   
                }
            });

        </script>
    </body>
</html>
