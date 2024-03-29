function deletar(){
    swal({
        text: 'Cadastro deletado com sucesso!',
        type: "success",
        showConfirmButton: false,
        timer: 3000
    });
}

function gostei(){
    swal({
        text: 'Gostei!',
        type: "success",
        showConfirmButton: false,
        timer: 3000,
    });
}
function naoGostei(){
    swal({
        text: 'Não Gostei!',
        type: "error",
        showConfirmButton: false,
        timer: 3000
    });
}

function mascaraFone(event) {
    var valor = document.getElementById("telephone").attributes[0].ownerElement['value'];
    var retorno = valor.replace(/\D/g, "");
    retorno = retorno.replace(/^0/, "");
    if (retorno.length > 10) {
        retorno = retorno.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
    } else if (retorno.length > 5) {
        if (retorno.length == 6 && event.code == "Backspace") {
            // necessário pois senão o "-" fica sempre voltando ao dar backspace
            return;
        }
        retorno = retorno.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
    } else if (retorno.length > 2) {
        retorno = retorno.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
    } else {
        if (retorno.length != 0) {
            retorno = retorno.replace(/^(\d*)/, "($1");
        }
    }
    document.getElementById("telephone").attributes[0].ownerElement['value'] = retorno;
}
