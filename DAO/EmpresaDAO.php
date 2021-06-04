<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class EmpresaDAO extends Conexao
{

    public function CadastrarEmpresa($nome, $telefone, $endereco)
    {
        if (trim($nome) == '') {
            return 0;
        }

        //1
        $conexao = parent::retornarConexao();

        //2
        $comando_sql = 'insert into tb_empresa(nome_empresa, telefone_empresa, endereco_empresa, id_usuario)
                    values(?,?,?,?)';

        //3
        $sql = new PDOStatement();

        //4
        $sql = $conexao->prepare($comando_sql);

        //5
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $telefone);
        $sql->bindValue(3, $endereco);
        $sql->bindValue(4, UtilDAO::CodigoLogado());

        try {
            //6
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ConsultarEmpresa()
    {
        $conexao = parent::retornarConexao();

        $comando_sql = 'select id_empresa,
                               nome_empresa,
                               telefone_empresa,
                               endereco_empresa
                            from tb_empresa
                             where id_usuario=? order by nome_empresa ASC';

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function AlterarEmpresa($id_empresa, $nome, $telefone, $endereco)
    {
        if (trim($nome) == '' || $id_empresa == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'update tb_empresa
                            set nome_empresa = ?,
                                telefone_empresa = ?,
                                endereco_empresa = ?
                            where id_empresa = ?
                                and id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $telefone);
        $sql->bindValue(3, $endereco);
        $sql->bindValue(4, $id_empresa);
        $sql->bindValue(5, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ExcluirEmpresa($id_empresa)
    {
        if ($id_empresa == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'delete 
                            from tb_empresa
                        where id_empresa = ? 
                        and id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $id_empresa);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try {
            $sql->execute();

            return 1;
        } catch (Exception $ex) {
            return -4;
        }
    }

    public function DetalharEmpresa($id_empresa)
    {
        $conexao = parent::retornarConexao();

        $comando_sql = 'select nome_empresa,
                               telefone_empresa,
                               endereco_empresa,
                               id_empresa
                            from tb_empresa
                                where id_empresa = ?
                                 and id_usuario = ?';

        $sql = new PDOStatement;

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $id_empresa);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }
}
