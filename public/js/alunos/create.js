  /* Mascaras */
  jQuery(function ($) {
      $("#NIS").mask("999.9999.9999",{placeholder:"999.9999.9999"});
      $("#FONE").mask("99-99999-9999");
      $("#FONE_II").mask("99-99999-9999");
      $("#SUS").mask("999.9999.9999.9999",{placeholder:"999.9999.9999.9999"});
      $("#CPF").mask("999.999.999-99",{placeholder:"999.9999.9999-99"});
  });
  /* Esconder elementod extras do transporte */
  $(document).ready(function () {
      $('#motoristas').hide();
      if ($('#inputTransporte').val() == 'SIM') {
          $('#motoristas').show("slow");
      } else {
          $('#motoristas').hide("slow");
      }
      $('#inputTransporte').change(function () {
          if ($('#inputTransporte').val() == 'SIM') {
              $('#motoristas').show("slow");
          } else {
              $('#motoristas').hide("slow");

          }
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
  /* Converte o texto para maiusculo */
  function handleInput(e) {
      var ss = e.target.selectionStart;
      var se = e.target.selectionEnd;
      e.target.value = e.target.value.toUpperCase();
      e.target.selectionStart = ss;
      e.target.selectionEnd = se;
  }
  $(document).ready(function () {

      /*  alert('aqui') */

  });
