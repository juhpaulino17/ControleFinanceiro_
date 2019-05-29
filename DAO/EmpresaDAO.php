<?php

require_once 'Conexao.class.php';

class EmpresaDAO extends Conexao {

    /** @var PDOStatement */
    private $instrucao_sql;

    /** @var PDO */
    private $conexao;

    public function InserirEmpresa($nome_empresa, $endereco_empresa, $telefone_empresa, $cod_usuario) {
        $this->conexao = parent ::getConexao();
        $this->instrucao_sql = "INSERT INTO tb_empresa" .
                " (nome_empresa,endereco_empresa,telefone_empresa,cod_usuario)" .
                "values(?,?,?,?)";
        $this->instrucao_sql = $this->conexao->prepare($this->instrucao_sql);
        // 4passo vincular valores com os links (?)
        $this->instrucao_sql->bindValue(1, $nome_empresa);
        $this->instrucao_sql->bindValue(2, $endereco_empresa);
        $this->instrucao_sql->bindValue(3, $telefone_empresa);
        $this->instrucao_sql->bindValue(4, $cod_usuario);
        $this->instrucao_sql->execute();
    }

    public function ConsultarEmpresa ($cod_usuario) {
        $this->conexao = parent ::getConexao();
        $this->instrucao_sql = 'SELECT nome_empresa, endereco_empresa, telefone_empresa, cod_empresa FROM tb_empresa WHERE cod_usuario =?';
        $this->instrucao_sql = $this->conexao->prepare($this->instrucao_sql); 
        $this->instrucao_sql->bindValue(1, $cod_usuario);
        $this->instrucao_sql->execute();
        return $this->instrucao_sql->fetchAll();
    }

    public function AlterarEmpresa($nome_empresa, $endereco_empresa, $telefone_empresa, $cod_empresa) {
        $this->conexao = parent ::getConexao();
        $this->instrucao_sql = "UPDATE tb_empresa SET nome_empresa=?, endereco_empresa=?, telefone_empresa=? WHERE cod_empresa =?";
        $this->instrucao_sql = $this->conexao->prepare($this->instrucao_sql);
        $this->instrucao_sql->bindValue(1, $nome_empresa);
        $this->instrucao_sql->bindValue(2, $endereco_empresa);
        $this->instrucao_sql->bindValue(3, $telefone_empresa);
        $this->instrucao_sql->bindValue(4, $cod_empresa);
        $this->instrucao_sql->execute();
    }

}
