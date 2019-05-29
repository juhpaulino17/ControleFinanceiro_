<?php

require_once '../DAO/UsuarioDAO.php';

class UsuarioController {

    public function InserirUsuario($nome, $email, $endereco, $senha, $repetir_senha, $datadocadastro) {

        if (empty(trim($nome)) || empty(trim($email)) || empty(trim($senha)) || empty(trim($repetir_senha)) || empty(trim($endereco))) {
            return 0;
        }
        if (strlen(trim($nome)) < 5) {
            return -2;
        }

        if (strlen(trim($senha)) < 6) {
            return -3;
        }

        if (trim($senha) != trim($repetir_senha)) {
            return -4;
        }
        $objdao = new UsuarioDAO();

        $ret = $objdao->InserirUsuario($nome, $email, $endereco, $senha, $datadocadastro);
        if ($ret > 0) {
            session_start();
            $_SESSION['cod_usuario'] = $ret;
            $_SESSION['nome_usuario'] =$nome;
            echo '<script>window.location.href="http://localhost/ControleFinanceiro/Html/principal.php"</script>';
        } else {
            return-1;
        }
    }

    public function ValidarLogin($email, $senha) {
        if (trim($email) == '' || trim($senha) == '') {
            return 0;
        }
        try {
            $objtdao = new UsuarioDAO();
            $usuario = $objtdao->ValidarLogin($email, $senha);
            if (count($usuario) > 0) {

                session_start();
                $_SESSION['cod_usuario'] = $usuario[0]['cod_usuario'];
                $_SESSION['nome_usuario'] = $usuario[0]['nome_usuario'];
                echo '<script>window.location.href="http://localhost/ControleFinanceiro/Html/principal.php"</script>';
            } else {
                return -2;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return-1;
        }
    }

}
