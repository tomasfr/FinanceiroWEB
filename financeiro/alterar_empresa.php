<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/EmpresaDAO.php';

$dao = new EmpresaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $id_empresa = $_GET['cod'];

    $dados = $dao->DetalharEmpresa($id_empresa);

    //Se tem alguma coisa dentro da ARRAY dados
    if (count($dados) == 0) {
        header('location: consultar_empresa.php');
        exit;
    }
} else if (isset($_POST['btnSalvar'])) {

    $id_empresa = $_POST['cod'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    $ret = $dao->AlterarEmpresa($id_empresa, $nome, $telefone, $endereco);

    header('location: consultar_empresa.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btnExcluir'])) {

    $id_empresa = $_POST['cod'];
    $ret = $dao->ExcluirEmpresa($id_empresa);

    header('location: consultar_empresa.php?ret=' . $ret);
    exit;
} else {
    header('location:consultar_empresa.php');
    exit;
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
                        <h2>Alterar empresa</h2>
                        <h5>Altere aqui suas empresas. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="alterar_empresa.php" method="post">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_empresa'] ?>">
                    <div class="form-group">
                        <label>Nome empresa *</label>
                        <input class="form-control" placeholder="Escreva aqui o nome da empresa" id="nome" name="nome" value="<?= $dados[0]['nome_empresa'] ?>" maxlength="55"/>
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input class="form-control" placeholder="Escreva aqui telefone da empresa (opcional)" id="telefone" name="telefone" value="<?= $dados[0]['telefone_empresa'] ?>" maxlength="11"/>
                    </div>
                    <div class="form-group">
                        <label>Endereço</label>
                        <input class="form-control" placeholder="Escreva aqui o endereço da empresa (opcional)" id="endereco" name="endereco" value="<?= $dados[0]['endereco_empresa'] ?>" maxlength="100"/>
                    </div>
                    <button type="submit" class="btn btn-success" onclick="return ValidarEmpresa()" name="btnSalvar">Salvar</button>
                    <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger">Excluir</button>

                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir a empresa: <b><?= $dados[0]['nome_empresa'] ?> ?</b>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary" name="btnExcluir">Sim</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>

</body>

</html>