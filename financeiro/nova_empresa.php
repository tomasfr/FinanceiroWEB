<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/EmpresaDAO.php';

if (isset($_POST['btnGravar'])){

    $nome = $_POST['nome'];
    $tel = $_POST['telefone'];
    $end = $_POST['endereco'];

    $objdao = new EmpresaDAO();

    $ret = $objdao->CadastrarEmpresa($nome, $tel, $end);

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
                        <h2>Cadastrar nova empresa</h2>
                        <h5>Cadastre aqui uma nova empresa. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="nova_empresa.php" method="post">
                <div class="form-group">
                    <label>Nome da empresa*</label>
                    <input class="form-control" placeholder="Escreva aqui o nome da empresa" id="nome" name="nome" maxlength="55"/>
                </div>
                <div class="form-group">
                    <label>Telefone</label>
                    <input class="form-control" placeholder="Escreva aqui telefone da empresa (opcional)" id="telefone" name="telefone" maxlength="11"/>
                </div>
                <div class="form-group">
                    <label>Endereço</label>
                    <input class="form-control" placeholder="Escreva aqui o endereço da empresa (opcional)" id="endereco" name="endereco" maxlength="100"/>
                </div>
                <button class="btn btn-success" onclick="return ValidarEmpresa()" name="btnGravar">Gravar</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>

</body>

</html>