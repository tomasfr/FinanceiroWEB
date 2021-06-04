function ValidarLogin() {
    if ($("#email").val().trim() == '') {
        alert("Preencha o campo EMAIL");
        return false;
    }

    if ($("#senha").val().trim() == '') {
        alert("Preencha o campo SENHA");
        return false;
    }

}

function ValidarCadastro() {
    if ($("#nome").val().trim() == '') {
        alert("Preencha o campo NOME");
        return false;
    }

    if ($("#email").val().trim() == '') {
        alert("Preencha o campo EMAIL");
        return false;
    }

    if ($("#senha").val().trim() == '') {
        alert("Preencha o campo SENHA");
        return false;
    }

    if ($("#senha").val().length < 6) {
        alert("O campo senha deve ter no mínimo 6 caracteres");
        return false;
    }

    if ($("#rsenha").val().trim() == '') {
        alert("Preencha o campo REPETIR SENHA");
        return false;
    }

    if ($("#senha").val() != $("#rsenha").val()) {
        alert("O campo REPETIR SENHA deve ser igual ao campo SENHA")
        return false;
    }

}

function ValidarCategoria() {
    if ($("#nome").val().trim() == '') {
        alert("Preenha o campo NOME");
        return false;
    }
}

function ValidarConta() {
    if ($("#banco").val().trim() == '') {
        alert("Preencha o campo BANCO");
        return false;
    }

    if ($("#agencia").val().trim() == '') {
        alert("Preencha o campo AGÊNCIA");
        return false;
    }

    if ($("#conta").val().trim() == '') {
        alert("Preencha o campo CONTA");
        return false;
    }

    if ($("#saldo").val().trim() == '') {
        alert("Preencha o campo SALDO")
        return false;
    }
}

function ValidarEmpresa() {
    if ($("#nome").val().trim() == '') {
        alert("Preencha o campo NOME DA EMPRESA");
        return false;
    }

}

function ValidarMovimento() {
    if ($("#tipo").val().trim() == '') {
        alert("Selecione o TIPO");
        return false;
    }

    if ($("#data").val().trim() == '') {
        alert("Selecione o DATA");
        return false;
    }

    if ($("#valor").val().trim() == '') {
        alert("Preencha o VALOR");
        return false;
    }

    if ($("#categoria").val().trim() == '') {
        alert("Selecione a CATEGORIA");
        return false;
    }

    if ($("#cempresa").val().trim() == '') {
        alert("Selecione a EMPRESA");
        return false;
    }

    if ($("#conta").val().trim() == '') {
        alert("Selecione a CONTA");
        return false;
    }

}

function ValidarConsMovimento() {

    if ($("#datai").val().trim() == '') {
        alert("Selecione a DATA INICIAL");
        return false;
    }

    if ($("#dataf").val().trim() == '') {
        alert("Selecione a DATA FINAL");
        return false;
    }
}

function ValidarDados() {
    if ($("#nome").val().trim() == '') {
        alert("Preencha o campo NOME");
        return false;
    }

    if ($("#email").val().trim() == '') {
        alert("Preencha o campo EMAIL");
        return false;
    }
}