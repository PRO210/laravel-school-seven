@extends('adminlte::page')

@section('title', 'Alunos')

@section('content_header')


@stop

@section('content')

<div class="card">
    <form action="#" method="post" class="">
        @csrf
        <div class="card-header"></div>
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
                                <span>
                                    <input type="checkbox" name="" class="checkbox selecionar" id="selecionar">
                                    &nbsp; Turma
                                </span>
                            </div>
                        </th>
                        <th>CURSANDO</th>
                        <th>TRANSF.</th>
                        <th>DESIST.</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alunoTurmas as $aluno)
                    @foreach ($aluno->turmas as $turma)
                    <tr>
                        <th>{{$turma->TURMA}}</th>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>TURMA</th>
                        <th>CURSANDO</th>
                        <th>TRANSF.</th>
                        <th>DESIST.</th>
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
