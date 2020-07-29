@extends('adminlte::page')

@section('title', 'turmas/alunos')

@section('content_header')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{ route('alunos.index') }}" class="active">Alunos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('turmas.index') }}" class="active">Turmas</a></li>
    </ol>
</nav>
@stop

@section('content')

@if(\Session::has('message'))

<div class="alert alert-success" id="vc" style="display: block;">
    <ul>
        <li>{!! \Session::get('message') !!}</li>
    </ul>
</div>

@endif

<style>
    .bi-tools {
        color: #8a6d3b !important;
    }

    .botao {
        margin: 6px;
        min-width: 180px;
    }

    .table td,
    .table th {
        padding: 8px;
    }

    .paddingButton {
        border-color: aliceblue;
        padding: 0px;
    }
</style>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<!-- DataTables -->
<script src='{{url("js/dataTables/jquery.dataTables.min.js")}}'></script>
<script src='{{url("js/dataTables/dataTables.bootstrap4.min.js")}}'></script>
<script src='{{url("js/dataTables/dataTables.responsive.min.js")}}'></script>
<script src='{{url("js/dataTables/responsive.bootstrap4.min.js")}}'></script>

<script>
    $(function() {
        $('form[name= "form"]').submit(function() {
            event.preventDefault();
            $.ajax({
                url: "{{route('turmas.aluno.solicicao.edit')}}",
                type: "post",
                data: $(this).serialize(),
                dataType: 'json',

                beforeSend: function() {

                    $("#divCorpo").html("<img src='{{URL('imgs/ajax-loader.gif')}}'>");
                },

                success: function(response) {

                    $("#SOLICITANTE").val(response.SOLICITANTE)
                    $("#TRANSFERENCIA_STATUS").val(response.TRANSFERENCIA_STATUS)
                    $("#DATA_TRANSFERENCIA_STATUS").val(response.DATA_TRANSFERENCIA_STATUS)

                    $('#myModal').delay(1000).queue(function(next) {
                        $(this).modal('show');
                    })

                    // $("#divCorpo")
                    //     .delay(3000)
                    //     .queue(function(next) {
                    //         // $(this).css('display', 'none');
                    //         $("#divCorpo").html("");
                    //     });

                    // $("#teste").delay(4000).queue(function(next) {

                    // });

                },
                error: function() {
                    console.log("erro");
                }

            })
        })
    });
</script>
<script>
    //Deixa os checkbox mais bonitos
    $(document).ready(function() {
        $(":checkbox").wrap("<span style='background-color:burlywood;padding: 4px; border-radius: 3px;padding-bottom: 4px;'>");
    });

    //Marcar ou Desmarcar todos os checkbox
    $(document).ready(function() {
        $('#selecionar').click(function() {
            if (this.checked) {
                $('.checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
    });
    //Valida o botão salvar com excel para não ir vázio
    $(document).ready(function() {
        $('input[type=checkbox]').on('change', function() {
            var total = $('input[type=checkbox]:checked').length;
            if (total > 0) {
                $('.botao').removeAttr('disabled');
            } else {
                $('.botao').attr('disabled', 'disabled');
            }
        });
    });
    /* Datatable */
    $(document).ready(function() {

        // Setup - add a text input to each footer cell
        $('#example tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="' + title + '" />');
        });
        var table = $('#example').DataTable({

            "columnDefs": [{
                "targets": 0,
                "orderable": false
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
        table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });

    });
</script>



@section('css')

<!-- DataTables CSS-->
<link rel="stylesheet" href="{{url('css/alunos/index.css')}}">
<link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css')}}">
<link rel="stylesheet" href="{{url('https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css')}}">

@stop

<form action="{{route('turmas.aluno.solicicao.update')}}" method="POST" class="form" name="form">
    @csrf
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-outline-secondary" data-toggle="modal" data-target="">Atualizar a Transferência</button>
                        <button type="button" class="btn btn-outline-success">Success</button>
                        <button type="button" class="btn btn-outline-danger">Danger</button>
                        <button type="button" class="btn btn-outline-warning">Warning</button>
                        <button type="button" class="btn btn-outline-info">Info</button>
                        <button type="submit" class="btn btn-outline-dark">Dark</button>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-outline-success paddingButton" data-toggle="dropdown">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 0 0-5.86 2.929 2.929 0 0 0 0 5.858z" />
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu">
                                                <button type="submit" class="btn btn-outline-success botao" name="botao" value="excel" id="btEditBloc" disabled title="Marque ao menos uma caixinha"><b>Salvar em Excel</b></button>
                                                <br>
                                                <button type="submit" class="btn btn-outline-primary botao" name="botao" value="update" id="" disabled title="Marque ao menos uma caixinha"><b>Edição em Bloco</b></button>
                                            </div>
                                            &nbsp;
                                            <span><input type="checkbox" name="" class="checkbox selecionar" id="selecionar"></span>

                                        </div>
                                    </th>
                                    <th>ALUNO</th>
                                    <th>TURMA</th>
                                    <th>STATUS</th>
                                    <!-- <th>STATUS DA TRANSFERÊNCIA</th>
                                    <th>ENTREGUE/PRONTA</th>
                                    <th>SOLICITANTE</th>
                                    <th>DATA SOLICITAÇÃO</th>
                                    <th>DECLARAÇÃO</th>
                                    <th>RESPONSÁVEL DA DECLARAÇÃO</th>
                                    <th>TRANSFERÊNCIA</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($solicitacoesAluno as $aluno)
                                @foreach ($aluno->turmas as $Key => $turma)
                                @endforeach
                                <tr>
                                    <th></th>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-outline-success paddingButton" data-toggle="dropdown">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 0 0-5.86 2.929 2.929 0 0 0 0 5.858z" />
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('alunos.edit',['uuid' => $aluno->uuid])}}" target='_self' title='Alterar o Cadastro'>
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil " fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" />
                                                        <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z" />
                                                    </svg><b>&nbsp;&nbsp;&nbsp;&nbsp;Alterar o Cadastro</b></a>

                                            </div>
                                            &nbsp;<span><input type='checkbox' name='aluno_selecionado[]' for='NOME' class='checkbox' value='{{$aluno->uuid}}/{{$turma->id}}/{{$aluno->solicitacaos[$Key]->pivot->id}}}}'></span>
                                            &nbsp;<span id="NOME">{{ $aluno->NOME }}</span>
                                        </div>
                                    </td>
                                    <td>{{$turma->TURMA}} {{$turma->UNICO}} ({{$turma->TURNO}}) - {{\Carbon\Carbon::parse($turma->ANO)->format('Y')}}</td>
                                    <td>
                                        @foreach($classificacoes as $classificacao)
                                        @if($turma->pivot->classificacao_id == "$classificacao->id")
                                        {{$classificacao->STATUS}}
                                        @endif
                                        @endforeach
                                    </td>
                                    <!-- <td>{{$aluno->solicitacaos[$Key]->pivot->TRANSFERENCIA_STATUS}}</td> -->
                                    <!-- <td>{{\Carbon\Carbon::parse($aluno->solicitacaos[$Key]->pivot->DATA_SOLICITACAO )->format('d-m-Y')}}</td>
                                    <td>{{$aluno->solicitacaos[$Key]->pivot->SOLICITANTE}}</td>
                                    <td>{{\Carbon\Carbon::parse($aluno->solicitacaos[$Key]->pivot->DATA_TRANSFERENCIA_STATUS )->format('d-m-Y')}}</td>
                                    <td>{{$aluno->solicitacaos[$Key]->pivot->DECLARACAO}}</td>
                                    <td>{{$aluno->solicitacaos[$Key]->pivot->RESPONSAVEL_DECLARACAO}}</td> -->

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th id="thTfoot"></th>
                                    <th>ALUNO</th>
                                    <th>TURMA</th>
                                    <th>STATUS</th>
                                    <!-- <th>STATUS DA TRANSFERÊNCIA</th>
                                    <th>ENTREGUE/PRONTA</th>
                                    <th>SOLICITANTE</th>
                                    <th>DATA SOLICITAÇÃO</th>
                                    <th>DECLARAÇÃO</th>
                                    <th>RESPONSÁVEL DA DECLARAÇÃO</th>
                                    <th>TRANSFERÊNCIA</th> -->
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <div class="container-fluid">
        <div class="row">
            <div class="col-sm">
                <button type="submit" name="salvar" value="salvar" class="btn btn-outline-success btn-block"><b>Adicionar / Salvar</b></button>
            </div>
            <div class="col-sm">
                <button type="submit" name="salvar" value="excluir" class="btn btn-outline-danger btn-block"><b>Excluir</b></button>
            </div>
        </div>
    </div> -->
    @include('turmas.alunos.solicitacoes.showModal')

</form>


@stop
