<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/CategoriaDAO.php';

if (isset($_POST['btnGravar'])) {

    $nome = $_POST['nome'];

    $objdao = new CategoriaDAO();

    $ret = $objdao->CadastrarCategoria($nome);
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
                        <?php include_once '_msg.php'; ?>
                        <h2>Nova Categoria</h2>
                        <h5>Aqui você cadastra suas novas categorias. Exemplo: conta de luz. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="nova_categoria.php" method="post">
                    <div class="form-group">
                        <label>Criar nova categoria *</label>
                        <input class="form-control" id="nome" name="nome" placeholder="Escreva aqui a nova categoria" maxlength="35"/>
                    </div>
                    <button type="submit" onclick="return ValidarCategoria()" name="btnGravar" class="btn btn-success">Cadastrar</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>

</body>

</html>