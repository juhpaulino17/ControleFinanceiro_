<?php

$nome='';
$Email='';
$Endereco='';
        
?>

<h2> Cadastro de Usuario<h2>
<form action="Cadastrar_usuario.php" method= "post">
    <label> Nome: </label>
    <input type=text" name="nome_usuario" id="nome_usuario" maxlength="45"value="<?= $nome?>"> 
    <br>
    <label> Email: </label> 
    <input type=text" name="email_usuario" id="email_usuario" maxlength="35"value="<?= $Email?>">
    <br>
    <label> Endereço: </label> 
    <input type=text" name="endereço_usuario" id="endereço_usuario" maxlength maxlength="60"value="<?= $Endereco?>">
    <br>
    <label> Senha: </label> 
    <input type=text" name="senha_usuario" id="senha_usuario" maxlength maxlength="8">
    <br>
    <label> Repetir Senha: </label> 
    <input type=text" name="reptir_senha" id="reptir_senha" maxlength maxlength="8">
    <br>
    <button name="btnCadastrar" id="btnCadastrar">Cadastrar </button>
     
</form>	


