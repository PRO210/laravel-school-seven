@extends('adminlte::page')

@section('title', 'turmas/alunos/solicitações')

@section('content_header')
<meta name="csrf-token" content="{{ csrf_token() }}">

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{ route('alunos.index') }}" class="active">Alunos</a></li>
        <li class="breadcrumb-item "><a href="{{ route('turmas.index') }}" class="active">Turmas</a></li>
        <li class="breadcrumb-item "><a href="{{ route('turmas.alunos.solicicaos') }}" class="active">Transferências</a></li>
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
    .bi-trash {
        color: red;
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
    function json() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //
        camposMarcados = new Array();
        $("input[type=checkbox][name='aluno_selecionado[]']:checked").each(function() {
            camposMarcados.push($(this).val());
        });
        $.ajax({
            type: 'POST',
            url: "{{route('turmas.aluno.solicicao.edit')}}",
            dataType: 'html',
            data: {
                'aluno_selecionado': camposMarcados,
                _token: $('#signup-token').val()
            },
            success: function(data) {

                $txt = JSON.parse(data);

                for (var i in $txt) {

                    var SOLICITANTE = $txt[i]["SOLICITANTE"];

                    //  var DATA_SOLICITACAO = $txt[i]["DATA_SOLICITACAO"];
                    var TRANSFERENCIA_STATUS = $txt[i]["TRANSFERENCIA_STATUS"];
                    var DATA_TRANSFERENCIA_STATUS = $txt[i]["DATA_TRANSFERENCIA_STATUS"];

                    var DECLARACAO = $txt[i]["DECLARACAO"];
                    var RESPONSAVEL_DECLARACAO = $txt[i]["RESPONSAVEL_DECLARACAO"];
                    var DATA_DECLARACAO = $txt[i]["DATA_DECLARACAO"];

                    var TRANSFERENCIA = $txt[i]["TRANSFERENCIA"];
                    var RESPONSAVEL_TRANSFERENCIA = $txt[i]["RESPONSAVEL_TRANSFERENCIA"];
                    var DATA_TRANSFERENCIA = $txt[i]["DATA_TRANSFERENCIA"];

                    var classificacao_id = $txt[i]["classificacao_id"];

                }
                $("#SOLICITANTE").val(SOLICITANTE)
                // $("#DATA_SOLICITACAO").val(DATA_SOLICITACAO)
                $("#TRANSFERENCIA_STATUS").val(TRANSFERENCIA_STATUS)
                $("#DATA_TRANSFERENCIA_STATUS").val(DATA_TRANSFERENCIA_STATUS)
                $("#DECLARACAO").val(DECLARACAO)
                $("#RESPONSAVEL_DECLARACAO").val(RESPONSAVEL_DECLARACAO)
                $("#DATA_DECLARACAO").val(DATA_DECLARACAO)
                $("#TRANSFERENCIA").val(TRANSFERENCIA)
                $("#RESPONSAVEL_TRANSFERENCIA").val(RESPONSAVEL_TRANSFERENCIA)
                $("#DATA_TRANSFERENCIA").val(DATA_TRANSFERENCIA)

                $("#classificacao_id").val(classificacao_id)

                $('#myModal').delay(0).queue(function(next) {
                    $(this).modal('show');
                })

            },
            error: function() {
                alert('Erro');
            }
        });
    };
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
</script>

@section('css')

<!-- DataTables CSS-->
<link rel="stylesheet" href="{{url('css/alunos/index.css')}}">
<link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css')}}">
<link rel="stylesheet" href="{{url('https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css')}}">

@stop

<form action="{{route('turmas.aluno.solicicao.update')}}" method="POST" class="form" name="form">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-outline-secondary botao" id="transferencia" onclick="return json()" disabled title="Selecione alguma caixinha">Atualizar a Transferência</button>
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
                                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-pencil " fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" />
                                                        <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z" />
                                                    </svg><b>&nbsp;&nbsp;&nbsp;&nbsp;Alterar o Cadastro</b></a>

                                                @if($turma->pivot->classificacao_id == 3)
                                                <a class="dropdown-item" href="{{route('turmas.aluno.arquivo',['uuid' => $aluno->uuid,'turma_id' => $turma->id])}}" target='_self' title='Mover para o Arquivo'>
                                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-folder-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M9.828 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91H9v1H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181L15.546 8H14.54l.265-2.91A1 1 0 0 0 13.81 4H9.828zm-2.95-1.707L7.587 3H2.19c-.24 0-.47.042-.684.12L1.5 2.98a1 1 0 0 1 1-.98h3.672a1 1 0 0 1 .707.293z" />
                                                        <path fill-rule="evenodd" d="M13.5 10a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z" />
                                                        <path fill-rule="evenodd" d="M13 12.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0v-2z" />
                                                    </svg><b>&nbsp;&nbsp;&nbsp;&nbsp;Mover para o Arquivo</b>
                                                </a>
                                                @else
                                                <a class="dropdown-item" href="#" target='_self' title='Não transferido ainda'>
                                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-folder-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M9.828 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91H9v1H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181L15.546 8H14.54l.265-2.91A1 1 0 0 0 13.81 4H9.828zm-2.95-1.707L7.587 3H2.19c-.24 0-.47.042-.684.12L1.5 2.98a1 1 0 0 1 1-.98h3.672a1 1 0 0 1 .707.293z" />
                                                        <path fill-rule="evenodd" d="M13.5 10a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z" />
                                                        <path fill-rule="evenodd" d="M13 12.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0v-2z" />
                                                    </svg>
                                                    <b>&nbsp;&nbsp;&nbsp;&nbsp;Aluno não transferido ainda</b>
                                                </a>
                                                @endif
                                                <a class="dropdown-item" href="{{route('turmas.aluno.solicicao.destroy',['uuid' => $aluno->uuid,'turma_id' => $turma->id])}}" target='_self' title='Deletar o Aluno(a)' onclick="return confirmar()">
                                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                    </svg>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;<b>Deletar o Aluno(a)</b>
                                                </a>
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

    @include('turmas.alunos.solicitacoes.showModal')
    <div style="margin-bottom: 60px;">
        <input type="hidden" id="usuario" value="{{ Auth::user()->name }}">
    </div>
</form>

@stop
