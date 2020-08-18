@extends('adminlte::page')

@section('title', 'Alunos')

@section('content_header')


@stop

@section('content')

<div class="card">
    <form action="#" method="" class="">
        @csrf
        <div class="card-header"></div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h3>Matutino</h3>
                    <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="example">
                        <thead>
                            <tr>
                                <th>Turma</th>
                                <th>Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alunoTurmas as $key => $alunoTurma)
                            <tr>
                                <td>{{$key}}</td>
                                <th>{{$alunoTurma}}</th>
                            </tr>
                            @php
                            $totalManha +=$alunoTurma;
                            @endphp
                            @endforeach
                            <tr>
                                <td style="text-align: right; font-weight: bold;">SOMA</td>
                                <td>{{$totalManha}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col">
                    <h3>Vespertino</h3>
                    <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="example">
                        <thead>
                            <tr>
                                <th>Turma</th>
                                <th>Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alunoTurmasVesp as $key => $alunoTurma)
                            <tr>
                                <td>{{$key}}</td>
                                <th>{{$alunoTurma}}</th>
                            </tr>
                            @php
                            $totalVespertino +=$alunoTurma;
                            @endphp
                            @endforeach
                            <tr>
                                <td style="text-align: right; font-weight: bold;">SOMA</td>
                                <td>{{$totalVespertino}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col">
                    <h3>Noturno</h3>
                    <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="example">
                        <thead>
                            <tr>
                                <th>Turma</th>
                                <th>Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alunoTurmasNoturno as $key => $alunoTurma)
                            <tr>
                                <td>{{$key}}</td>
                                <th>{{$alunoTurma}}</th>
                            </tr>
                            @php
                            $totalNoturno +=$alunoTurma;
                            @endphp
                            @endforeach
                            <tr>
                                <td style="text-align: right; font-weight: bold;">SOMA</td>
                                <td>{{$totalNoturno}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
    </form>
</div>
</div>
<div style="margin-bottom: 60px;">
    <input type="hidden" id="usuario" value="{{ Auth::user()->name }}">
</div>


@stop
