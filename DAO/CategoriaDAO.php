<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class CategoriaDAO extends Conexao{

    public function CadastrarCategoria($nome){

        if(trim($nome) == ''){
            return 0;
        }

        //1 passo: criar uma variavel que recebera o obj de conexao
        $conexao = parent :: retornarConexao();

        //2 Criar uma variavel que receberá o texto do comando SQL que deverá ser executado no BD
        $comando_sql = 'insert into tb_categoria
                        (nome_categoria, id_usuario)
                        values (?, ?);';
    
        //3 Passo: criar um obj que será config. e levado para o BD para ser executado
        $sql = new PDOStatement();

        //4 Passo: Colocar dentro do obj $sql a conexão preparada para executar o comanando_sql
        $sql = $conexao->prepare($comando_sql);

        //5 Passo: Verificar se no comando_sql eu tenho "?" para ser configurado. Se tiver, configurar os BindValues
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try{
            //6 Passo: executar no BD
            $sql->execute();
            return 1;
        }
        catch(Exception $ex){
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ConsultarCategoria(){

        $conexao = parent::retornarConexao();

        $comando_sql = 'select id_categoria,
                                nome_categoria
                        from tb_categoria
                            where id_usuario = ? order by nome_categoria ASC';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();

    }

    public function AlterarCategoria($nome, $id_categoria){

        if(trim($nome) == '' || trim($id_categoria) == ''){
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'update tb_categoria
                            set nome_categoria = ?
                            where id_categoria = ?
                                and id_usuario = ?';
                                

        $sql = new PDOStatement;

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $id_categoria);
        $sql->bindValue(3, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;

        }catch(Exception $ex){
            echo $ex->getMessage();
            return -1;

        }
    }

    public function ExcluirCategoria($id_categoria){
        if($id_categoria == ''){
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'delete 
                            from tb_categoria 
                        where id_categoria = ?
                        and id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $id_categoria);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try{
            $sql->execute();
            
            return 1;
        }catch(Exception $ex){
            return -4;
        }
    }

    public function DetalharCategoria($id_categoria){

        $conexao = parent::retornarConexao();

        $comando_sql = 'select nome_categoria,
                               id_categoria
                        from tb_categoria
                         where id_categoria = ?
                         and id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $id_categoria);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();

    }
}