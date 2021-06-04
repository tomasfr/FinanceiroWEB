<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class UsuarioDAO extends Conexao{

    public function CarregarMeusDados(){
        $conexao = parent::retornarConexao();

        $comando_sql = 'select nome_usuario,
                               email_usuario
                        from tb_usuario
                            where id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        //Remove os index dentro do 
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        //Retornar resultado pesquisado
        return $sql->fetchAll();


    }

    public function GravarMeusDados($nome, $email){

        if(trim($nome) == '' || trim($email) == ''){
            return 0;
        }

        if($this->VerificarEmailDuplicadoAlteracao($email) != 0){
            return -5;
        }
        
        $conexao = parent::retornarConexao();

        $comando_sql = 'update tb_usuario
                                set nome_usuario = ?,
                                    email_usuario = ?
                                where id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, UtilDAO::CodigoLogado());

        try{
            $sql->execute();

            return 1;
        }catch(Exception $ex){
            echo $ex->getMessage();
            
            return -1;

        }

    }

    public function ValidarLogin($email, $senha){

        if(trim($email) == '' || trim($senha) == ''){
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'select id_usuario, nome_usuario from tb_usuario
                            where email_usuario = ? and senha_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $email);
        $sql->bindValue(2, $senha);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        $user = $sql->fetchAll();

        if(count($user) == 0){
            return -6;
        }

        $cod = $user[0]['id_usuario'];
        $nome = $user[0]['nome_usuario'];
        UtilDAO::CriarSessao($cod, $nome);
        header('location: inicial.php');
        exit;
    }

    public function VerificarEmailDuplicadoCadastro($email){
        if(trim($email == '')){
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'select count(email_usuario) as contar
                        from tb_usuario where email_usuario = ?';
        
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $email);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        $contar = $sql->fetchAll();

        return $contar[0]['contar'];

    }

    public function VerificarEmailDuplicadoAlteracao($email){
        if(trim($email == '')){
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'select count(email_usuario) as contar
                        from tb_usuario where email_usuario = ? and id_usuario != ?';
        
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $email);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        $contar = $sql->fetchAll();

        return $contar[0]['contar'];

    }

    public function CriarCadastro($nome, $email, $senha, $rsenha){

        if(trim($nome) == '' || trim($email) == '' || trim($senha) == '' || trim($rsenha) == ''){
            return 0;
        }

        if(strlen($senha) < 6){
            return -2;
        }

        if(trim($senha) != trim($rsenha)){
            return -3;
        }
        
        if($this->VerificarEmailDuplicadoCadastro($email) != 0){
            return -5;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = 'insert into tb_usuario
                        (nome_usuario, email_usuario, senha_usuario, data_cadastro)
                        values
                        (?,?,?,?)';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, $senha);
        $sql->bindValue(4, date('Y-m-d'));

        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            echo $ex->getMessage();
            return -1;
        }

    }
}
