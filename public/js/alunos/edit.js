 /* Mascaras */
 jQuery(function ($) {
     $("#NIS").mask("999.9999.9999",{placeholder: "999.9999.9999"});
     $("#FONE").mask("99-99999-9999");
     $("#FONE_II").mask("99-99999-9999");
     $("#SUS").mask("999.9999.9999.9999",{placeholder: "999.9999.9999.9999"});
     $("#CPF").mask("999.999.999-99");
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
