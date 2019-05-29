<?php

require_once '../DAO/EmpresaDAO.php';

class EmpresaController {

    public function InserirEmpresa($nome_empresa, $endereco_empresa, $telefone_empresa, $cod_usuario) {


        if (empty(trim($nome_empresa))) {
            return -2;
        }

        if (empty(trim($endereco_empresa))) {
            return -3;
        }

        if (empty(trim($telefone_empresa))) {
            return -4;
        }
        $objtdao = new EmpresaDAO();
        try {
            $objtdao->InserirEmpresa($nome_empresa, $endereco_empresa, $telefone_empresa, $cod_usuario);
            return 1;
        } catch (Exception $exc) {
            echo $exc->getmessage();
            return-1;
        }
    }

    public function ConsultarEmpresa($cod_usuario) {
        $objtdao = new EmpresaDAO();
        $listaEmpresa = $objtdao->ConsultarEmpresa($cod_usuario);
        return $listaEmpresa;
    }

    public function AlterarEmpresa($nome_empresa, $endereco_empresa, $telefone_empresa, $cod_empresa) {
        if (empty(trim($nome_empresa))) {
            return -2;
        }

        if (empty(trim($endereco_empresa))) {
            return -3;
        }

        if (empty(trim($telefone_empresa))) {
            return -4;
        }

        $objtdao = new EmpresaDAO();
        try {
            $objtdao->AlterarEmpresa($nome_empresa, $endereco_empresa, $telefone_empresa, $cod_empresa);
            return 1;
        } catch (Exception $exc) {
            echo $exc->getmessage();
            return-1;
        }
    }

}
