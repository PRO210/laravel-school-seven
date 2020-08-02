@extends('adminlte::page')

@section('title', 'table')

@section('content_header')

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


@section('js')
<!-- jQuery -->
<script src='{{url("js/jquery-3.5.1.js")}}' type="text/javascript"></script>
<!-- DataTables -->
<script src='{{url("js/dataTables/jquery.dataTables.min.js")}}'></script>
<script src='{{url("js/dataTables/dataTables.bootstrap4.min.js")}}'></script>
<script src='{{url("js/dataTables/dataTables.responsive.min.js")}}'></script>
<script src='{{url("js/dataTables/responsive.bootstrap4.min.js")}}'></script>
<script src='{{url("js/turmas/alunos/index.js")}}'></script>
@stop

@section('css')
<!-- DataTables CSS-->
<link rel="stylesheet" href="{{url('css/alunos/index.css')}}">
<link rel="stylesheet" href="{{url('css/bootstrap.css')}}">
<link rel="stylesheet" href="{{url('css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('css/responsive.bootstrap4.min.css')}}">
@stop

<form action="#" method="POST" class="form" name="form">
    @csrf
    @method('PUT')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- <div class="card-header">Turmas Disponíveis</div> --}}
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
                                    <th>USUÁRIO</th>
                                    <th>AÇÃO</th>
                                    <th>DETALHES</th>
                                    <th>DATA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logAlunos as $logAluno)
                                @foreach ($logAluno->atualizacoes as $key => $atualizacao)
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
                                                <a class="dropdown-item" href="#" target='_self' title='Alterar o Cadastro'>
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil " fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" />
                                                        <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z" />
                                                    </svg><b>&nbsp;&nbsp;&nbsp;&nbsp;Alterar o Cadastro</b></a>

                                            </div>
                                            &nbsp;<span><input type='checkbox' name='aluno_selecionado[]' for='NOME' class='checkbox' value=''></span>
                                            &nbsp;<span id="NOME">
                                                @foreach($users as $user)
                                                @if($atualizacao->pivot->user_id == "$user->id")
                                                {{$user->name}}
                                                @endif
                                                @endforeach
                                            </span>
                                        </div>
                                    </td>
                                    <td>{{$atualizacao->pivot->ACAO}}</td>

                                    <td>{{$atualizacao->pivot->ACAO_DETALHES}}</td>
                                    <td>{{\Carbon\Carbon::parse($atualizacao->created_at)->format('d-m-Y')}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th id="thTfoot"></th>
                                    <th>USUÁRIO</th>
                                    <th>AÇÃO</th>
                                    <th>DETALHES</th>
                                    <th>DATA</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


</form>


@stop
