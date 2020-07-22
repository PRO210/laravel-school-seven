@include('alerts')

@extends('adminlte::page')

@section('title', 'turmas/alunos')

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{ route('alunos.index') }}" class="active">Alunos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('turmas.alunos') }}" class="active">Turmas</a></li>
        <li class="breadcrumb-item active"><a href="#" class="active">Edição em Grupo</a></li>
    </ol>
</nav>
@stop
<style>
    fieldset {
        /* background-color: rgba(111, 66, 193, 0.3); */
        border-radius: 4px;
        margin-bottom: 12px !important;
        border: solid thin blue !important;

    }
    legend {
        background-color: #fff;
        border: 1px solid blue;
        border-radius: 4px;
        /*  color: var(--purple); */
        font-size: 17px;
        font-weight: bold;
        padding: 3px 5px 3px 7px;
        width: auto;
    }
</style>

@section('content')

@section('js')
<!--Turmas-->
<script type="text/javascript">
    $(document).ready(function() {
        // $("#divTurmas").hide();
        $("#btnTurmas").click(function() {
            $("#divTurmas").toggle(2000);
        });
    });
</script>
@stop

<div class="card">
    <!-- <div class="card-header"></div> -->
    <div class="card-body">
        <form action="{{ route('turmas.alunos.update') }}" method="POST" class="" id="form">
            @csrf
            @method('PUT')
            <button type="button" class="btn btn-outline-primary" id="btnTurmas">Turmas</button>
            <button type="button" class="btn btn-outline-secondary">Secondary</button>
            <button type="button" class="btn btn-outline-success">Success</button>
            <button type="button" class="btn btn-outline-danger">Danger</button>
            <button type="button" class="btn btn-outline-warning">Warning</button>
            <button type="button" class="btn btn-outline-info">Info</button>
            <button type="button" class="btn btn-outline-dark">Dark</button>
            <span style="margin: 12px;">
                <p></p>
            </span>
            <!--Turmas e Status-->
            <div class="row justify-content-center" style="margin-top: 12px; display:none" id="divTurmas" >
                <fieldset class="col-sm-12 col-md-12 px-6">
                    <legend>&nbsp;Turmas e Status:</legend>
                    <div class="row">
                        <label for="" class="col-sm-1 col-form-label">TURMAS:</label>
                        <div class="col-sm-5">
                            <select name="turma_id" id="" class="form-control">
                                @foreach($turmas as $turma)
                                <option value="{{$turma->id}}">{{$turma->TURMA}} {{$turma->UNICO}} ({{$turma->TURNO}}) - {{\Carbon\Carbon::parse($turma->ANO)->format('Y')}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="" class="col-sm-1 control-label">Status:</label>
                        <div class="col-sm-5">
                            <select name="classificacao_id" id="" class="form-control">
                                @foreach($classificacoes as $classificacao)
                                <option value="{{$classificacao->id}}">{{$classificacao->STATUS}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><br><br>
                    <button type="submit" class="btn btn-outline-success btn-block">Salvar</button>
                    <br>
                </fieldset>
            </div>
            <!--  <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}">&nbsp;
            <button type="submit" class="btn btn-dark" name="botao">Filtrar</button>&nbsp; -->
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>
                            <span><input type="checkbox" name="" class="checkbox selecionar" id="" checked></span>
                            <span>NOME</span>
                        </th>
                        <th>NASCIMENTO</th>
                        <th>TURMA</th>
                        <th>STATUS</th>
                        <th>MÃE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alunos as $aluno)
                    @foreach ($aluno->turmas as $Key => $turma)
                    @endforeach
                    <tr>

                        <td>
                            &nbsp;<span><input type='checkbox' name='aluno_selecionado[]' class='checkbox' value='{{$aluno->uuid}}/{{$turma->id}}/{{$turma->pivot->id}}' checked></span>
                            &nbsp;<span>{{ $aluno->NOME }}</span>
                        </td>
                        <td>{{\Carbon\Carbon::parse($aluno->NASCIMENTO)->format('d/m/Y')}}</td>
                        <td>{{$turma->TURMA}} {{$turma->UNICO}} ({{$turma->TURNO}}) - {{\Carbon\Carbon::parse($turma->ANO)->format('Y')}}</td>
                        <td>
                            @foreach($classificacoes as $classificacao)
                            @if($turma->pivot->classificacao_id == "$classificacao->id")
                            {{$classificacao->STATUS}}
                            @endif
                            @endforeach
                        </td>
                        <td>{{$aluno->MAE}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
    <div class="card-footer">

    </div>
    <div style="margin-bottom: 60px;">
        <input type="hidden" id="usuario" value="{{ Auth::user()->name }}">
    </div>

</div>

@stop
