@extends('adminlte::page')

@section('title', 'Alunos/Relatórios')

@section('content_header')


@stop

@section('content')

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
<link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css')}}">
<link rel="stylesheet" href="{{url('https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('https://cdn.datatables.net/responsive/2.2.5/css/responsive.bootstrap4.min.css')}}">

@stop

<div class="card">
    <form action="{{route('turmas.alunos.relatorios.gerados')}}" method="post" class="">
        @csrf
        <div class="card-header"></div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="">
                        <thead>
                            <tr>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classificacoes as $classificacao)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" name="classificacao_id[]" class="form-check-input" id="{{$classificacao->id}}" value="{{$classificacao->id}}">&nbsp;
                                        <label class="form-check-label" for="{{$classificacao->id}}">{{$classificacao->STATUS}}</label>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!--  SEXO -->
                <div class="col">
                    <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="">
                        <thead>
                            <tr>
                                <th>SEXO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="radio" name="SEXO" class="form-check-input" id="TODOS" value="" checked>&nbsp;
                                        <label class="form-check-label" for="TODOS">TODOS</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="radio" name="SEXO" class="form-check-input" id="MASCULINO" value="MASCULINO">&nbsp;
                                        <label class="form-check-label" for="MASCULINO">MASCULINO</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="radio" name="SEXO" class="form-check-input" id="FEMININO" value="FEMININO">&nbsp;
                                        <label class="form-check-label" for="FEMININO">FEMININO</label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--  OUVINTE -->
                <div class="col">
                    <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="">
                        <thead>
                            <tr>
                                <th>OUVINTE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="radio" name="OUVINTE" class="form-check-input" id="TODOSOUVINTE" value="" checked>&nbsp;
                                        <label class="form-check-label" for="TODOSOUVINTE">TODOS</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="radio" name="OUVINTE" class="form-check-input" id="SIM" value="SIM">&nbsp;
                                        <label class="form-check-label" for="SIM">SIM</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="radio" name="OUVINTE" class="form-check-input" id="NAO" value="NAO">&nbsp;
                                        <label class="form-check-label" for="NAO">NÃO</label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- SEGUNDA LINHA -->
            <div class="row">
                <div class="col">
                    <!--  NECESSIDADES_ESPECIAIS -->
                    <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="">
                        <thead>
                            <tr>
                                <th>NECESSIDADES_ESPECIAIS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="radio" name="NECESSIDADES_ESPECIAIS" class="form-check-input" id="NECESSIDADES_ESPECIAIS" value="" checked>&nbsp;
                                        <label class="form-check-label" for="NECESSIDADES_ESPECIAIS">TODOS</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="radio" name="NECESSIDADES_ESPECIAIS" class="form-check-input" id="NECESSIDADES_ESPECIAIS_SIM" value="SIM">&nbsp;
                                        <label class="form-check-label" for="NECESSIDADES_ESPECIAIS_SIM">SIM</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="radio" name="NECESSIDADES_ESPECIAIS" class="form-check-input" id="NECESSIDADES_ESPECIAIS_NAO" value="NAO">&nbsp;
                                        <label class="form-check-label" for="NECESSIDADES_ESPECIAIS_NAO">NÃO</label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--  TRANSPORTE -->
                <div class="col">
                    <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="">
                        <thead>
                            <tr>
                                <th>TRANSPORTE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="radio" name="TRANSPORTE" class="form-check-input" id="TRANSPORTE" value="" checked>&nbsp;
                                        <label class="form-check-label" for="TRANSPORTE">TODOS</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="radio" name="TRANSPORTE" class="form-check-input" id="TRANSPORTE_SIM" value="SIM">&nbsp;
                                        <label class="form-check-label" for="TRANSPORTE_SIM">SIM</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="radio" name="TRANSPORTE" class="form-check-input" id="TRANSPORTE_NAO" value="NAO">&nbsp;
                                        <label class="form-check-label" for="TRANSPORTE_NAO">NÃO</label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" name="salvar" value="salvar" class="btn btn-outline-success btn-block" onclick="return confirmar()" title="Selecione ao menos uma turma">
                    <b>Gerar Relatório</b>
                </button>
            </div>
        </div>
        <br>
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>
                        <span><input type="checkbox" name="" class="checkbox selecionar" id="selecionar">&nbsp;&nbsp;</span>
                    </th>
                    <th>TURMA</th>
                    <th>TURNO</th>
                    <th>CATEGORIA</th>
                    <th>ANO</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($turmas as $Key => $turma)
                <tr>
                    <td></td>
                    <td>
                        &nbsp;<span><input type='checkbox' name='turma_id[]' for='NOME' class='checkbox' value='{{$turma->id}}'></span>
                        &nbsp;<span id="NOME">{{$turma->TURMA}} {{$turma->UNICO}} </span>
                    </td>
                    <td>{{$turma->TURNO}}</td>
                    <td>{{$turma->CATEGORIA}}</td>
                    <td>{{\Carbon\Carbon::parse($turma->ANO)->format('Y')}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th id="thTfoot"></th>
                    <th>TURMA</th>
                    <th>TURNO</th>
                    <th>CATEGORIA</th>
                    <th>ANO</th>
                </tr>
            </tfoot>
        </table>
</div>
</form>
</div>

@stop
