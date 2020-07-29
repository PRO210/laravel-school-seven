@extends('adminlte::page')

@section('title', 'turmas/alunos')

@section('content_header')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{ route('alunos.index') }}" class="active">Alunos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('turmas.index') }}" class="active">Turmas</a></li>
        <li class="breadcrumb-item active"><a href="#" class="active">Solicitações</a></li>
    </ol>
</nav>
@stop

@section('content')
<div class="container-fluid">
    <form action="{{route('turmas.aluno.solicicao.store')}}" method="post">
        @csrf
        <p>ALUNO(A): <b>{{$aluno->NOME}} da Turma: {{$turma->TURMA}} {{$turma->UNICO}} ({{$turma->TURNO}}) - {{\Carbon\Carbon::parse($turma->ANO)->format('Y')}}</b>.</p>
        @if($alunoSolicitacaoCont > 0)
        <h4>Existem pedidos de transferências pendentes relacionado ao aluno(a). Por favor Pesquise!</h4>
        @else
        <h4>Não existe pedidos de transferências pendentes relacionado ao aluno(a). Por favor Solcite!</h4>

        @endif
        <div class="form-group row ">
            <label for="" class="col-sm-2 col-form-label">Solicitante</label>
            <div class="col-sm-4">
                <input type="text" name="SOLICITANTE" id="" class="form-control" placeholder="" >
            </div>
            <label for="" class="col-sm-2 col-form-label">Data</label>
            <div class="col-sm-4">
                <input type="date" name="DATA_SOLICITACAO" id="" class="form-control" placeholder="" >
            </div>
        </div>
        <div>
            <input type="hidden" id="usuario" value="{{ Auth::user()->name }}">
        </div>
        <div>
            <input type="hidden" name="turma_id" value="{{$turma->id}}">
        </div>
        <div>
            <input type="hidden" name="aluno_id" value="{{$aluno->uuid}}">
        </div>






        <div class="container-fluid">
            <div class="row">
                <div class="col-sm">
                    <button type="submit" name="botao" value="salvar" class="btn btn-outline-success btn-block"><b>Adicionar</b></button>
                </div>
                <div class="col-sm">
                    <button type="submit" name="botao" value="pesquisar" class="btn btn-outline-danger btn-block"><b>Pesquisar</b></button>
                </div>
            </div>
        </div>

    </form>
</div>

@stop
