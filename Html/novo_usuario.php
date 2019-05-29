<?php
require_once '../Controller/UsuarioController.php';
$nome = '';
$email = '';
$endereco = '';

if (isset($_POST['btnCadastrar'])) {
    $nome = $_POST['nome_usuario'];
    $email = $_POST['email_usuario'];
    $endereco = $_POST['endereco_usuario'];
    $senha = $_POST['senha_usuario'];
    $repetir_senha = $_POST['repetir_senha'];
    $datacadastro = date('y-m-d');


    $objusuario = new UsuarioController();
    $ret = $objusuario->InserirUsuario($nome, $email, $endereco, $senha, $repetir_senha, $datacadastro);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Novo Usuario</title>
        <!-- BOOTSTRAP STYLES-->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLES-->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
        <link href="assets/css/custom.css" rel="stylesheet" />
        <!-- GOOGLE FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        <!-- JQUERY SCRIPTS -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- METISMENU SCRIPTS -->
        <script src="assets/js/jquery.metisMenu.js"></script>
        <!-- CUSTOM SCRIPTS -->
        <script src="assets/js/custom.js"></script>  
    </head>
    <body>
        <div class="container">
            <div class="row text-center  ">
                <div class="col-md-12">
                    <br /><br />
                    <h2>Cadastrar</h2>

                    <h5>( Prencha o formulario abaixo )</h5>
                    <br />
                </div>
            </div>
            <div class="row">

                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <?php
                            if (isset($ret)) {

                                if ($ret == 0) {
                                    echo '<div class="alert-warning">Preencher campos obrigatórios</div>';
                                } else if ($ret == -1) {
                                    echo '<div class="alert-danger">Ocorreu um erro tente mais tarde.</div>';
                                } else if ($ret == -2) {
                                    echo '<div class="alert-warning">Preencher seu NOME COMPLETO./div>';
                                } else if ($ret == -3) {
                                    echo '<div class="alert-warning">Criar uma senha com no minimo 6 caracteres</div>';
                                } else if ($ret == -4) {
                                    echo '<div class="alert-warning">O campo SENHA e REPETIR SENHA não conferem</div>';
                                }
                            }
                            ?>

                            <form action="novo_usuario.php" method="post">
                                <br/>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                    <input type=text" class="form-control" name="nome_usuario" id="nome_usuario" maxlength="45" placeholder="Digite seu nome" value="<?= $nome ?>">
                                </div>

                                <div class="form-group input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="text" class="form-control"name="email_usuario" id="email_usuario" maxlength="35" placeholder="Digite seu Email" value="<?= $email ?>">
                                </div>

                                <div class="form-group input-group">
                                    <span class="input-group-addon">^</span>
                                    <input type="text" class="form-control" name="endereco_usuario" id="endereco_usuario" maxlength="35" placeholder="Digite seu Endereço" value="<?= $endereco ?>">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                    <input type="password" class="form-control" name="senha_usuario" id="senha_usuario" maxlength="40" placeholder="Digite a Senha" >
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                    <input type="password" class="form-control" name="repetir_senha" id="repetir_senha" maxlength="40" placeholder="Repitir Senha" >
                                </div>

                                <button class="btn btn-success" id="btnCadastrar" name="btnCadastrar" >Cadastrar</button>
                                <hr />
                                Possui Cadastro?  <a href="login.php" >Logar</a>
                            </form>
                        </div>

                    </div>
                </div>


            </div>
        </div>

        <script>
            $("#btnCadastrar").click(function () {

                if ($("#nome_usuario").val().trim() == "") {
                    alert("Prencher o campo NOME");
                    return false;
                }
                if ($("#email_usuario").val().trim() == "") {
                    alert("Prencher o campo EMAIL");
                    return false;
                }
                if ($("#endereco_usuario").val().trim() == "") {
                    alert("Prencher o campo Endereço");
                    return false;
                }
                if ($("#senha_usuario").val().trim() == "") {
                    alert("Prencher o campo SENHA");
                    return false;
                }
                if ($("#repetir_senha").val().trim() == "") {
                    alert("Prencher o campo REPETIR SENHA");
                    return false;
                }

                if ($("#nome_usuario").val().trim().length < 5) {
                    alert("Preencher seu NOME COMPLETO");
                    return false;
                }

                if ($("#senha_usuario").val().trim() != $("#repetir_senha").val().trim()) {
                    alert("O campo SENHA e REPTIR SENHA não conferem");
                    return false;
                }
                if ($("#senha_usuario").val().trim().length < 6) {
                    alert("Criar uma senha com no minimo 6 caracteres");
                    return false;
                }
            })
        </script>
    </body>
</html>

