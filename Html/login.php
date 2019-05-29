<?php
$ret = '';
$email = '';

if (isset($_POST['btn_entrar'])) {
    $email = $_POST['email_usuario'];
    $senha = $_POST['senha_usuario'];
   
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Controle Financeiro</title>
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
        <div class="container">
            <div class="row text-center ">
                <div class="col-md-12">
                    <br /><br />
                    <h2> Faça seu login</h2>

                    <br />
                </div>
            </div>
            <div class="row ">

                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>   Entre com seus dados </strong>  
                        </div>
                        <div class="panel-body">
                       
                            <form action="login.php" method="post">
                                <br />
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                    <input type="text" class="form-control" id="email_usuario" name="email_usuario" placeholder="Seu Email " />
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                    <input type="password" class="form-control" id="senha_usuario" name="senha_usuario" placeholder="Sua senha" />
                                </div>
                                <button class="btn btn-primary "id="btn_entrar" name="btn_entrar">Entrar</button>
                                <hr />
                                Não é cadastrado? <a href="novo_usuario.php." >Clique Aqui</a> 
                            </form>
                        </div>

                    </div>
                </div>


            </div>
        </div>
        <script>
            $("#btn_entrar").click(function () {

                if ($("#email_usuario").val().trim() === "") {
                    alert("Preencher o campo EMAIL USUARIO");
                    return false;
                }
                if ($("#senha_usuario").val().trim() === "") {
                    alert("Preencher o campo SUA SENHA");
                    return false;
                }

            });
        </script>
    </body>
</html>

