<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/ContaDAO.php';

if (isset($_POST['btnGravar'])){

    $banco = $_POST['banco'];
    $agencia = $_POST['agencia'];
    $conta = $_POST['conta'];
    $saldo = $_POST['saldo'];

    $objdao = new ContaDAO();

    $ret = $objdao->CadastrarConta($banco, $agencia, $conta, $saldo);
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
include_once '_head.php';
?>

<body>
    <div id="wrapper">

        <?php
        include_once '_topo.php';
        include_once '_menu.php';
        ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once '_msg.php' ?>
                        <h2>Nova Conta</h2>
                        <h5>Cadastre aqui uma nova conta. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="nova_conta.php" method="post">
                    <div class="form-group">
                        <label>Nome do Banco*</label>
                        <input class="form-control" placeholder="Digite o nome do banco" id="banco" name="banco" maxlength="20"/>
                    </div>
                    <div class="form-group">
                        <label>Agência*</label>
                        <input class="form-control" placeholder="Digite o número da agência" id="agencia" name="agencia" maxlength="12"/>
                    </div>
                    <div class="form-group">
                        <label>Número da conta*</label>
                        <input class="form-control" placeholder="Digite o número da conta" id="conta" name="conta" maxlength="12"/>
                    </div>
                    <div class="form-group">
                        <label>Saldo*</label>
                        <input class="form-control" placeholder="Digite o saldo da conta" id="saldo" name="saldo" />
                    </div>
                    <button type="submit" class="btn btn-success" onclick="return ValidarConta()" name="btnGravar">Gravar</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>

</body>

</html>