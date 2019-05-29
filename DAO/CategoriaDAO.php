<?php

require_once 'Conexao.class.php';

class CategoriaDAO extends Conexao {

    /** @var PDOStatement */
    private $instrucao_sql;

    /** @var PDO */
    private $conexao;

    public function InserirCategoria($nome_categoria, $cod_usuario) {
        $this->conexao = parent ::getConexao();
        $this->instrucao_sql = "INSERT INTO tb_categoria" .
                " (nome_categoria,cod_usuario)" .
                "values(?,?)";
        $this->instrucao_sql = $this->conexao->prepare($this->instrucao_sql);
        $this->instrucao_sql->bindValue(1, $nome_categoria);
        $this->instrucao_sql->bindValue(2, $cod_usuario);
        $this->instrucao_sql->execute();
    }

    public function ConsultarCategoria($cod_usuario) {
        $this->conexao = parent ::getConexao();
        $this->instrucao_sql = 'SELECT cod_categoria,nome_categoria FROM tb_categoria WHERE cod_usuario =?';
        $this->instrucao_sql = $this->conexao->prepare($this->instrucao_sql);
        $this->instrucao_sql->bindValue(1, $cod_usuario);
        $this->instrucao_sql->execute();
        return $this->instrucao_sql->fetchAll();
    }

    public function AlterarCategoria($nome_categoria, $cod_categoria) {
        $this->conexao = parent ::getConexao();
        $this->instrucao_sql = "UPDATE tb_categoria SET nome_categoria = ? WHERE cod_categoria =?";
        $this->instrucao_sql = $this->conexao->prepare($this->instrucao_sql);
        $this->instrucao_sql->bindValue(1, $nome_categoria);
        $this->instrucao_sql->bindValue(2, $cod_categoria);
        $this->instrucao_sql->execute();
    }
}