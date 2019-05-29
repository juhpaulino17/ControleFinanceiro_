<?php

require_once '../DAO/CategoriaDAO.php';

class CategoriaController {

    public function InserirCategoria($nome_categoria, $cod_usuario) {

        if (empty(trim($nome_categoria))) {
            return 0;
        }


        $objtdao = new CategoriaDAO();
        try {
            $objtdao->InserirCategoria($nome_categoria, $cod_usuario);
            return 1;
        } catch (Exception $exc) {
            echo $exc->getmessage();
            return-1;
        }
    }

    public function ConsultarCategoria($cod_usuario) {
        $objtdao = new CategoriaDAO();
        $listacategoria = $objtdao->ConsultarCategoria($cod_usuario);
        return $listacategoria;
    }

    public function AlterarCategoria($nome_categoria, $cod_categoria) {
        if (empty(trim($nome_categoria))) {
            return 0;
        }

        $objtdao = new CategoriaDAO();
        try {
            $objtdao->AlterarCategoria($nome_categoria, $cod_categoria);
            return 1;
        } catch (Exception $exc) {
            echo $exc->getmessage();
            return-1;
        }
    }

}
