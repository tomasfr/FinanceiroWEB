<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/MovimentoDAO.php';
require_once '../DAO/CategoriaDAO.php';
require_once '../DAO/EmpresaDAO.php';
require_once '../DAO/ContaDAO.php';

$dao_cat = new CategoriaDAO();
$dao_emp = new EmpresaDAO();
$dao_con = new ContaDAO();



if(isset($_POST['btnGravar'])){
    $tipo = $_POST['tipo'];
    $data = $_POST['data'];
    $valor = $_POST['valor'];
    $categoria = $_POST['categoria'];
    $empresa = $_POST['empresa'];
    $conta = $_POST['conta'];
    $obs = $_POST['obs'];

    $objdao = new MovimentoDAO();

    $ret = $objdao->RealizarMovimento($tipo, $data, $valor, $categoria, $empresa, $conta, $obs);

}

$categorias = $dao_cat->ConsultarCategoria();
$empresas = $dao_emp->ConsultarEmpresa();
$contas = $dao_con->ConsultarConta();


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
                        <h2>Realizar movimento</h2>
                        <h5>Aqui você poderá realizar seus movimentos de entrada ou saída. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="realizar_movimento.php" method="post">

                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Tipo do movimento*</label>
                            <select class="form-control" id="tipo" name="tipo">
                                <option value="">Selecione</option>
                                <option value="1">Entrada</option>
                                <option value="2">Saída</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Data*</label>
                            <input type="date" class="form-control" placeholder="Coloque a data do movimento" id="data" name="data"/>
                        </div>
                        <div class="form-group">
                            <label>Valor*</label>
                            <input class="form-control" placeholder="Digite o valor do movimento" id="valor" name="valor" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Categoria*</label>
                            <select class="form-control" id="categoria" name="categoria">
                                <option value="">Selecione</option>
                                <?php foreach($categorias as $item){ ?>
                                    <option value="<?= $item['id_categoria']?>">
                                        <?= $item['nome_categoria']?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Empresa*</label>
                            <select class="form-control" id="empresa" name="empresa">
                                <option value="">Selecione</option>
                                <?php foreach($empresas as $item){ ?>
                                    <option value="<?= $item['id_empresa']?>">
                                        <?= $item['nome_empresa'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Conta*</label>
                            <select class="form-control" id="conta" name="conta">
                                <option value="">Selecione</option>

                                <?php foreach($contas as $item){ ?>
                                    <option value="<?= $item['id_conta'] ?>">
                                        <?= 'Banco: ' . $item['banco_conta'] . ', Agência / Número: ' . $item['agencia_conta'] . ' / ' . $item['numero_conta'] . ' - Saldo: R$ ' . $item['saldo_conta']?>
                                    </option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Observação (opcional)</label>
                            <textarea class="form-control" rows="3" id="obs" name="obs" maxlength="100"></textarea>
                        </div>
                        <button class="btn btn-success" onclick="return ValidarMovimento()" name="btnGravar">Gravar</button>
                    </div>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>

</body>

</html>