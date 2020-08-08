@extends('adminlte::page')

@section('title', 'Alunos')

@section('content_header')

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('alunos.index') }}" class="active">Alunos</a></li>
</ol>

<h3>Alunos &nbsp;<a href="{{ route('alunos.create') }}" class="btn btn-outline-success ">ADD</a></h3>

@stop

@section('content')

@section('css')
<!-- DataTables CSS-->
<link rel="stylesheet" href="{{url('css/alunos/index.css')}}">
<link rel="stylesheet" href="{{url('css/alunos/index.css')}}">
<link rel="stylesheet" href="{{url('css/bootstrap.css')}}">
<link rel="stylesheet" href="{{url('css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('css/responsive.bootstrap4.min.css')}}">

<style>
    .paddingButton {
        border-color: aliceblue;
        padding: 0px;
    }

    .botao {
        margin: 6px;
        min-width: 180px;
    }

    .table td,
    .table th {
        padding: 8px;
    }

    .checkbox {
        display: inline-block;
    }

    .bi {
        font-size: 20px;
    }

    .bi-trash {
        color: red;
    }

    .bi-tools {
        color: #8a6d3b;

    }
</style>

@stop

@section('js')
<!-- jQuery -->
<script src='{{url("js/jquery-3.5.1.js")}}' type="text/javascript"></script>
<script src='{{url("js/alunos/maskedInput.js")}}'></script>
<script src='{{url("/js/alunos/edit.js")}}'></script>
<!-- DataTable -->
<script src='{{url("js/dataTables/jquery.dataTables.min.js")}}'></script>
<script src='{{url("js/dataTables/dataTables.bootstrap4.min.js")}}'></script>
<script src='{{url("js/dataTables/dataTables.responsive.min.js")}}'></script>
<script src='{{url("js/dataTables/responsive.bootstrap4.min.js")}}'></script>
<script src='{{url("js/turmas/alunos/index.js")}}'></script>
@stop

<div class="card">
    <form action="{{ route('alunos.search') }}" method="post" class="">
        @csrf
        <div class="card-header">
            <input type="text" name="filter" placeholder="Nome" class="" value="{{ $filters['filter'] ?? '' }}">&nbsp;
            <button type="submit" class="btn btn-dark" name="botao">Filtrar</button>&nbsp;
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="example">
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
                                    <button type="submit" class="btn btn-outline-primary botao" name="botao" value="update" id="btEditBloc" disabled title="Marque ao menos uma caixinha"><b>Edição em Bloco</b></button>
                                </div>
                                &nbsp;
                                <span><input type="checkbox" name="" class="checkbox selecionar" id="selecionar"></span>
                            </div>
                        </th>
                        <th>ALUNO</th>
                        <th>NASCIMENTO</th>
                        <th>MÃE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alunos as $aluno)
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
                                        </svg><b>&nbsp;&nbsp;&nbsp;&nbsp;Alterar o Cadastro</b>
                                    </a>
                                    <a class="dropdown-item" href="{{route('turmas.aluno.show',['uuid' => $aluno->uuid])}}" target='_self' title='Incluir na Turma'>
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-tools" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10.146 7.646a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L12.793 11l-2.647-2.646a.5.5 0 0 1 0-.708z" />
                                            <path fill-rule="evenodd" d="M2 11a.5.5 0 0 1 .5-.5H13a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 11zm3.854-9.354a.5.5 0 0 1 0 .708L3.207 5l2.647 2.646a.5.5 0 1 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0z" />
                                            <path fill-rule="evenodd" d="M2.5 5a.5.5 0 0 1 .5-.5h10.5a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                                        </svg>
                                        &nbsp;&nbsp;<b> Incluir/Retirar na Turma</b>
                                    </a>
                                    <a class="dropdown-item" href="{{route('alunos.destroy',['uuid' => $aluno->uuid])}}" target='_self' title='Deletar o Aluno(a)' onclick="return confirmar()">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                        </svg>
                                        &nbsp;&nbsp; <b>Deletar o Aluno(a)</b>
                                    </a>
                                </div>
                                &nbsp;<span><input type='checkbox' name='aluno_selecionado[]' class='checkbox' value='{{$aluno->uuid}}'></span>
                                &nbsp;<span id="NOME">{{$aluno->NOME}}</span>
                            </div>
                        </td>
                        <td>{{\Carbon\Carbon::parse($aluno->NASCIMENTO)->format('d/m/Y')}}</td>
                        <td>{{$aluno->MAE}} </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th id="thTfoot"></th>
                        <th>ALUNO</th>
                        <th>NASCIMENTO</th>
                        <th>MÃE</th>
                    </tr>
                </tfoot>
            </table>
    </form>
</div>
</div>
<div style="margin-bottom: 60px;">
    <input type="hidden" id="usuario" value="{{ Auth::user()->name }}">
</div>


@stop
