<?php

require_once '../DAO/MovimentoDAO.php';

class MovimentoController {

    public function RealizarMovimento($tipo_movimento, $data_movimento, $valor_movimento, $obs_movimento, $cod_usuario, $cod_categoria, $cod_empresa) {

        if (empty(trim($tipo_movimento)) || empty(trim($data_movimento)) || empty(trim($valor_movimento)) || empty(trim($cod_categoria)) || empty(trim($cod_empresa))) {
            return 0;
        }
        $objtdao = new MovimentoDAO();
        try {

            $data_movimento = explode('/', $data_movimento)[2] . '-' . explode('/', $data_movimento)[1] . '-' . explode('/', $data_movimento)[0];
            $objtdao->RealizarMovimento($tipo_movimento, $data_movimento, $valor_movimento, $obs_movimento, $cod_usuario, $cod_categoria, $cod_empresa);
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ConsultarMovimento($tipo_movimento, $data_inicial, $data_final, $cod_usuario) {

        if (trim($data_inicial) == '' || trim($data_final) == '') {
            return 0;
        }

        try {
            $objtdao = new MovimentoDAO();

            $data_inicial = explode('/', $data_inicial)[2] . '-' . explode('/', $data_inicial)[1] . '-' . explode('/', $data_inicial)[0];
            $data_final = explode('/', $data_final)[2] . '-' . explode('/', $data_final)[1] . '-' . explode('/', $data_final)[0];

            $lista_movimento = $objtdao->ConsultarMovimento($tipo_movimento, $data_inicial, $data_final, $cod_usuario);

            return $lista_movimento;
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

      public function UltimosMovimentos($cod_usuario) {
         $objtdao = new MovimentoDAO();
         return $objtdao->UltimosMovimentos($cod_usuario);
         
      }
}
