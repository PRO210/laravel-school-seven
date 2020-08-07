   //Confirmar se pode salvar
   function confirmar() {
       var u = $('#usuario').val();
       var r = confirm("Já Posso Enviar " + u + "?\n\nLembre-se que isso apagara todos os registros do Aluno(a)!");
       if (r == true) {
           return true;
       } else {
           return false;
       }
   }
   //Marcar ou Desmarcar todos os checkbox
   $(document).ready(function () {
       $('.selecionar').click(function () {
           if (this.checked) {
               $('.checkbox').each(function () {
                   this.checked = true;
               });
           } else {
               $('.checkbox').each(function () {
                   this.checked = false;
               });
           }
       });
   });
   //Valida o botão salvar com excel para não ir vázio
   $('input[type=checkbox]').on('change', function () {
       var total = $('input[type=checkbox]:checked').length;
       if (total > 0) {

           $('#btEditBloc').removeAttr('disabled');
       } else {
           $('#btEditBloc').attr('disabled', 'disabled');
       }
   });
   //Deixa os checkbox mais bonitos
   $(document).ready(function () {
       $(":checkbox").wrap("<span style='background-color:burlywood;padding: 4px; border-radius: 3px;padding-bottom: 4px;'>");
   });
   /* Datatable */
   $(document).ready(function () {

       // Setup - add a text input to each footer cell
       $('#example tfoot th').each(function () {
           var title = $(this).text();
           $(this).html('<input type="text" placeholder="' + title + '" />');
       });
       var table = $('#example').DataTable({

           "columnDefs": [{
               "targets": 0,
               "orderable": false,
               "type": 'date-br',
               "targets": 2
           }],
           "lengthMenu": [
               [5, 10, 15, 20, 100, -1],
               [5, 10, 15, 20, 100, "All"]
           ],
           "language": {
               "lengthMenu": "_MENU_ ",
               "zeroRecords": "Nenhum aluno encontrado",
               "info": "Mostrando pagina _PAGE_ de _PAGES_",
               "infoEmpty": "Sem registros",
               "search": "Busca:",
               "infoFiltered": "(filtrado de _MAX_ total de alunos)",
               "paginate": {
                   "first": "Primeira",
                   "last": "Ultima",
                   "next": "Proxima",
                   "previous": "Anterior"
               },
               "aria": {
                   "sortAscending": ": ative a ordenação cressente",
                   "sortDescending": ": ative a ordenação decressente"
               }
           },

       });
       // Apply the search
       table.columns().every(function () {
           var that = this;
           $('input', this.footer()).on('keyup change', function () {
               if (that.search() !== this.value) {
                   that
                       .search(this.value)
                       .draw();
               }
           });
       });
       jQuery.extend(jQuery.fn.dataTableExt.oSort, {
           "date-br-pre": function (a) {
               if (a == null || a == "") {
                   return 0;
               }
               var brDatea = a.split('/');
               return (brDatea[2] + brDatea[1] + brDatea[0]) * 1;
           },

           "date-br-asc": function (a, b) {
               return ((a < b) ? -1 : ((a > b) ? 1 : 0));
           },

           "date-br-desc": function (a, b) {
               return ((a < b) ? 1 : ((a > b) ? -1 : 0));
           }
       });

   });
