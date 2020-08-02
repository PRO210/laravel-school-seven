      /* Mascara para o NIS  */
      $(function () {
        $("#NIS").mask("999.9999.9999", {
            reverse: true,
        });
    });
    /* Mascara para o FONE  */
    $(function () {
        $("#FONE").mask("99-99999-9999", {
            reverse: true,
        });
    });
    /* Mascara para o FONE 02  */
    $(function () {
        $("#FONE_II").mask("99-99999-9999", {
            reverse: true,
        });
    });
    /* Mascara para o SUS  */
    $(function () {
        $("#SUS").mask("999.9999.9999.9999", {
            reverse: true,
        });
    });
    /* Mascara para o CPF  */
    $(function () {
        $("#CPF").mask("999.999.999-99", {
            reverse: true,
        });
    });
  //Confirmar se pode salvar
  function confirmar() {
    var u = $('#usuario').val();
    var r = confirm("Já Posso Enviar " + u + "? ");
    if (r == true) {
        return true;
    } else {
        return false;
    }
}
