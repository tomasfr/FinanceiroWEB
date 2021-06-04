<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class ContaDAO extends Conexao
{

    public function CadastrarConta($banco, $agencia, $numero, $saldo)
    {

        if (trim($banco) == '' || trim($agencia) == '' || trim($numero) == '' || trim($saldo) == '') {
            return 0;
        }
        //1 Variavel que recebe obj de Conexao
        $conexao = parent::retornarConexao();

        //2 comando que sera enviado ao BD
        $comando_sql = 'insert into tb_conta
                        (banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
                        values(?,?,?,?,?)';

        //3 criar objeto (funciona como uma bolsa) que receberá as informaçoes e direçoes para envio ao BD
        $sql = new PDOStatement;

        //4 prepara para envio
        $sql = $conexao->prepare($comando_sql);

        //5 "encher a bolsa" com as informaçoes que sarao enviadas ao BD
        $sql->bindValue(1, $banco);
        $sql->bindValue(2, $agencia);
        $sql->bindValue(3, $numero);
        $sql->bindValue(4, $saldo);
        $sql->bindValue(5, UtilDAO::CodigoLogado());

        try {
            //6 enviar e testar erro
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function AlterarConta($id_conta, $banco, $agencia, $numero, $saldo)
    {

        if (trim($banco) == '' || trim($agencia) == '' || trim($numero) == '' || trim($saldo) == '' || $id_conta == '') {
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'update tb_conta
                            set banco_conta = ?,
                                agencia_conta = ?,
                                numero_conta = ?,
                                saldo_conta = ?
                            where id_conta = ?
                             and id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $banco);
        $sql->bindValue(2, $agencia);
        $sql->bindValue(3, $numero);
        $sql->bindValue(4, $saldo);
        $sql->bindValue(5, $id_conta);
        $sql->bindValue(6, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ConsultarConta()
    {
        $conexao = parent::retornarConexao();

        $comando_sql = 'select id_conta,
                                banco_conta,
                                agencia_conta,
                                numero_conta,
                                saldo_conta
                            from tb_conta
                             where id_usuario=? order by banco_conta';

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function ExcluirConta($id_conta)
    {
        if($id_conta == ''){
            return 0;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'delete 
                            from tb_conta 
                        where id_conta = ?
                        and id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $id_conta);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try{
            $sql->execute();

            return 1;
        }catch(Exception $ex){
            return -4;
        }
    }

    public function DetalharConta($id_conta)
    {
        $conexao = parent::retornarConexao();

        $comando_sql = 'select banco_conta,
                             agencia_conta,
                             numero_conta,
                             saldo_conta,
                             id_conta
                        from tb_conta
                         where id_conta = ?
                            and id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $id_conta);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function ConsultarSaldo(){
        $conexao = parent::retornarConexao();

        $comando_sql = 'select sum(saldo_conta) as total
                            from tb_conta
                            where id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }
}