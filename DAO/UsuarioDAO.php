<?php

require_once 'Conexao.class.php';

class UsuarioDAO extends Conexao {

    /** @var PDOStatement */
    private $instrucao_sql;

    /** @var PDO */
    private $conexao;

    public function InserirUsuario($nome, $email, $endereco, $senha, $datadocadastro) {
        // 1 PASSO: Resgatar a Conexao
        $this->conexao = parent ::getConexao();
        // 2 PASSO Montar instrução SQL
        $this->instrucao_sql = "INSERT INTO tb_usuario" .
                " (nome_usuario,email_usuario,endereco_usuario,senha_usuario,data_cadastro)" .
                "values(?,?,?,?,?)";

        //3 passo:Preparar para executar
        $this->instrucao_sql = $this->conexao->prepare($this->instrucao_sql);
        // 4passo vincular valores com os links (?)
        $this->instrucao_sql->bindValue(1, $nome);
        $this->instrucao_sql->bindValue(2, $email);
        $this->instrucao_sql->bindValue(3, $endereco);
        $this->instrucao_sql->bindValue(4, $senha);
        $this->instrucao_sql->bindValue(5, $datadocadastro);

        $this->instrucao_sql->execute();

        try {
            $codgravado = $this->conexao->lastInsertId();
            return $codgravado;
        } catch (Exception $ex) {
            return-1;
        }
    }

    public function ValidarLogin($email, $senha) {
        $this->conexao = parent ::getConexao();
        $this->instrucao_sql = "SELECT nome_usuario, cod_usuario "
                . " FROM tb_usuario WHERE email_usuario =? AND  senha_usuario =?";
        $this->instrucao_sql = $this->conexao->prepare($this->instrucao_sql);
        $this->instrucao_sql->bindValue(1, $email);
        $this->instrucao_sql->bindValue(2, $senha);
        $this->instrucao_sql->execute();
        
        return $this->instrucao_sql->fetchAll();
    }

}
