<?php
session_start();
if(isset($_POST['btn_sair'])){
    unset($_SESSION['cod_usuario']);
    unset($_SESSION['nome_usuario']);
    echo '<script>window.location.href="http://localhost/ControleFinanceiro/Html/login.php"</script>';
}
?>
<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="principal.php">Financeiro</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Olá,<?php  echo $_SESSION['nome_usuario'] ?> <form method="post"> <button class="btn btn-danger square-btn-adjust"name="btn_sair">Sair</button> </form> </div>
        </nav>   


