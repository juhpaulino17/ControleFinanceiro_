<?php

require_once 'Conexao.class.php';

class MovimentoDAO extends Conexao {

    /** @var PDOStatement */
    private $instrucao_sql;

    /** @var PDO */
    private $conexao;

    public function RealizarMovimento($tipo_movimento, $data_movimento, $valor_movimento, $obs_movimento, $cod_usuario, $cod_categoria, $cod_empresa) {

        $this->conexao = parent ::getConexao();

        $this->instrucao_sql = "INSERT INTO tb_movimento(tipo_movimento, data_movimento, valor_movimento, obs_movimento,cod_usuario,cod_categoria,cod_empresa)" .
                "values(?,?,?,?,?,?,?)";
        $this->instrucao_sql = $this->conexao->prepare($this->instrucao_sql);
        $this->instrucao_sql->bindValue(1, $tipo_movimento);
        $this->instrucao_sql->bindValue(2, $data_movimento);
        $this->instrucao_sql->bindValue(3, $valor_movimento);
        $this->instrucao_sql->bindValue(4, $obs_movimento);
        $this->instrucao_sql->bindValue(5, $cod_usuario);
        $this->instrucao_sql->bindValue(6, $cod_categoria);
        $this->instrucao_sql->bindValue(7, $cod_empresa);
        $this->instrucao_sql->execute();
    }

    public function ConsultarMovimento($tipo, $data_inicial, $data_final, $cod_usuario) {

        $this->conexao = parent::getConexao();
        if ($tipo == -1) {
            $this->instrucao_sql = "SELECT tipo_movimento, data_movimento , valor_movimento, obs_movimento, nome_empresa, nome_categoria"
                    . " FROM tb_movimento INNER JOIN tb_empresa ON tb_movimento.cod_empresa = tb_empresa.cod_empresa"
                    . " INNER JOIN tb_categoria ON tb_movimento.cod_categoria = tb_categoria.cod_categoria"
                    . " WHERE tb_movimento.cod_usuario = ? AND data_movimento BETWEEN ? AND ?";
        } else {
            $this->instrucao_sql = "SELECT tipo_movimento, data_movimento , valor_movimento, obs_movimento, nome_empresa, nome_categoria"
                    . " FROM tb_movimento INNER JOIN tb_empresa ON tb_movimento.cod_empresa = tb_empresa.cod_empresa"
                    . " INNER JOIN tb_categoria ON tb_movimento.cod_categoria = tb_categoria.cod_categoria"
                    . " WHERE tb_movimento.cod_usuario = ? AND data_movimento BETWEEN ? AND ? AND tipo_movimento=?";
        }

        $this->instrucao_sql = $this->conexao->prepare($this->instrucao_sql);

        if ($tipo == -1) {
            $this->instrucao_sql->bindValue(1, $cod_usuario);
            $this->instrucao_sql->bindValue(2, $data_inicial);
            $this->instrucao_sql->bindValue(3, $data_final);
        } else {
            $this->instrucao_sql->bindValue(1, $cod_usuario);
            $this->instrucao_sql->bindValue(2, $data_inicial);
            $this->instrucao_sql->bindValue(3, $data_final);
            $this->instrucao_sql->bindValue(4, $tipo);
        }

        $this->instrucao_sql->execute();

        return $this->instrucao_sql->fetchAll();
    }

    public function UltimosMovimentos($cod_usuario) {

        $this->conexao = parent::getConexao();

        $this->instrucao_sql = "SELECT tipo_movimento, data_movimento , valor_movimento, obs_movimento, nome_empresa, nome_categoria"
                . " FROM tb_movimento INNER JOIN tb_empresa ON tb_movimento.cod_empresa = tb_empresa.cod_empresa"
                . " INNER JOIN tb_categoria ON tb_movimento.cod_categoria = tb_categoria.cod_categoria"
                . " WHERE tb_movimento.cod_usuario = ? order by tb_movimento.data_movimento DESC LIMIT 10";

        $this->instrucao_sql = $this->conexao->prepare($this->instrucao_sql);
        $this->instrucao_sql->bindValue(1, $cod_usuario);
        $this->instrucao_sql->execute();
        return $this->instrucao_sql->fetchAll();
    }

}
