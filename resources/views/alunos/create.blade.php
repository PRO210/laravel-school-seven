@extends('adminlte::page')

@section('title', 'Cadastrar Novo Aluno(a)')

@section('content_header')
<h3>Cadastrar Novo Aluno(a)</h3>
@stop

@section('content')

@section('js')
<!-- jQuery -->
<!-- <script src="{{url('//oss.maxcdn.com/jquery.mask/1.11.4/jquery.mask.min.js')}}"></script>
<script src="{{url('/vendor/StatesAndCities/js/blit-states-and-cities.js')}}"></script> -->
<script src="{{url('js/alunos/maskedInput.js')}}" type="text/javascript"></script>
<script src="{{url('js/alunos/create.js')}}" type="text/javascript"></script>
@stop


<style>
    fieldset {
        /* background-color: rgba(111, 66, 193, 0.3); */
        border-radius: 4px;
        border: 1px solid blue;
        padding-bottom: 12px;
    }

    legend {
        background-color: #fff;
        border: 1px solid blue;
        border-radius: 4px;
        color: var(--purple);
        font-size: 17px;
        font-weight: bold;
        padding: 3px 5px 3px 7px;
        width: auto;
    }
</style>

<div class="card">
    <div class="card-body">
        <form action="{{route('alunos.store')}}" method="post" class="">
            @csrf
            <!-- <div class="row">
                <div class="form-group col-sm-12">
                    <label for="" class="col-sm-2 control-label">Nome do Aluno(a)</label>
                    <div class="col-sm-4">
                        <input type="text" name="NOME" id="" class="form-control" placeholder="" required>
                    </div>
                    <label for="" class="col-sm-2 control-label">Nascimento</label>
                    <div class="col-sm-4">
                        <input type="date" name="NASCIMENTO" id="" class=" form-control">
                    </div>
                </div>
            </div> -->
            <div class="row justify-content-center">
                <fieldset class="col-sm-12 col-md-12 px-6">
                    <legend>Dados Pessoais:</legend>
                    <!-- <div class="row ">
            <div class="form-group col-sm-9 col-lg-6">
                <label class="pt-2 col-sm-1" for="">Nome:</label>
                <div class="input-group">
                    <input type="text" name="NOME" id="" class="form-control" placeholder="Nome do Aluno(a)" required>
                </div>
            </div>
            <div class="form-group col-sm-9 col-lg-6">
                <label class="pt-2 " for="cost">NASCIMENTO:</label>
                <div class="input-group">
                    <input type="date" name="NASCIMENTO" id="" class="form-control">
                </div>
            </div>
        </div> -->
                    <div class="row">
                        <label for="" class="col-sm-1 col-form-label">NOME:</label>
                        <div class="col-sm-6">
                            <input type="text" name="NOME" id="" class="form-control" placeholder="Nome do Aluno(a)" required>
                        </div>
                        <label for="" class="col-sm-2 col-form-label">NASCIMENTO:</label>
                        <div class="col-sm-3">
                            <input type="date" name="NASCIMENTO" id="" class="form-control">
                        </div>
                    </div><br>
                    <div class="row">
                        <label for="" class="col-sm-2 col-form-label">CERTIDÃO CIVIL:</label>
                        <div class="col-sm-4">
                            <select name="CERTIDAO_CIVIL" id="" class="form-control">
                                <option value="NASCIMENTO" selected>NASCIMENTO</option>
                                <option value="CASAMENTO">CASAMENTO</option>
                            </select>
                        </div>
                        <label for="" class="col-sm-2 col-form-label">Matricula da Certidão:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="MATRICULA_CERTIDAO" placeholder="XXXXXXXXXX  XXXX  X  XXXXX  XXX  XXXXXXX  XX">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="" class="col-sm-2  control-label">Modelo da Certidão:</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="MODELO_CERTIDAO" id="">
                                <option value="NOVO">NOVO</option>
                                <option value="VELHO">VELHO</option>
                            </select>
                        </div>
                        <label for="" class="col-sm-2 control-label">Dados da Certidão:</label>
                        <div class="col-sm-4" id="">
                            <input type="text" class="form-control" id="" name="DADOS_CERTIDAO" placeholder="Termo N° XXX,  FLS: xxx,  Livro: xx.">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="" class="col-sm-2 control-label">Expedição:</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="" name="EXPEDICAO_CERTIDAO">
                        </div>
                        <label for="" class="col-sm-2 control-label">Cor/Raça:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="" name="COR" placeholder="Cor declarada pelo Aluno(a)">
                        </div>
                    </div>
                </fieldset>
            </div><br>
            <!-- DAdos de Identificação -->
            <div class="row justify-content-center">
                <fieldset class="col-sm-12 col-md-12 px-6">
                    <legend>Dados de Identificação:</legend>
                    <div class="row">
                        <label for="NIS" class="col-sm-2 control-label">Nis:</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" id="NIS" name="NIS" placeholder="">
                        </div>
                        <label for="" class="col-sm-2 control-label ">Bolsa Família:</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="BOLSA_FAMILIA" id="">
                                <option value="NAO" selected>NÃO</option>
                                <option>SIM</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="SUS" class="col-sm-2 control-label">SUS:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="SUS" name="SUS">
                        </div>
                        <label for="CPF" class="col-sm-2 control-label">CPF:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="CPF" name="CPF">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="" class="col-sm-1 control-label">RG:</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="" name="NUMERO_RG" placeholder="Nº do RG">
                        </div>
                        <label for="" class="col-sm-2 control-label">Orgão Expedidor:</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="" name="ORGAO_EXPEDIDOR_RG">
                        </div>
                        <label for="" class="col-sm-2 control-label">Expedição:</label>
                        <div class="col-sm-2">
                            <input type="date" class="form-control" id="" name="EXPEDICAO_RG">
                        </div>
                    </div>
                </fieldset>
            </div><br>
            <!-- Parentesco  -->
            <div class="row justify-content-center">
                <fieldset class="col-sm-12 col-md-12 px-6">
                    <legend>Parentesco:</legend>
                    <div class="row">
                        <label for="" class="col-sm-2 control-label">Nacionalidade</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="" name="NACIONALIDADE">
                            <!-- <select name="NACIONALIDADE" id="country" class="form-control" data-default="{{ config('states-and-cities.default-country') }}"></select> -->
                        </div>
                        <label for="inputSexo" class="col-sm-2  control-label">Sexo</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="SEXO" id="" required>
                                <option value="---------" selected>Marque uma Opção</option>
                                <option value="MASCULINO">MASCULINO</option>
                                <option value="FEMININO">FEMININO</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="" class="col-sm-2 control-label">Estado</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="" name="ESTADO">
                            <!-- <select name="ESTADO" id="state" class="form-control" data-default="{{ config('states-and-cities.default-state') }}"></select> -->
                        </div>
                        <label for="" class="col-sm-2 control-label ">Naturalidade</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="" name="NATURALIDADE">
                            <!-- <select name="NATURALIDADE" id="city" class="form-control" data-default="{{ config('states-and-cities.default-city') }}"></select> -->
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <label for="" class="col-sm-2 control-label">Nome do Pai</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="" name="PAI" onkeyup="maiuscula(this)">
                        </div>
                        <label for="" class="col-sm-2 control-label">Profissão do Pai</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="" name="PROF_PAI" onkeyup="maiuscula(this)">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="" class="col-sm-2 control-label">Nome da Mãe</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="" name="MAE" onkeyup="maiuscula(this)">
                        </div>
                        <label for="" class="col-sm-2 control-label">Profissão da Mãe</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="" name="PROF_MAE" onkeyup="maiuscula(this)">
                        </div>
                    </div>
                </fieldset>
            </div>
            <br>
            <!-- Localização  -->
            <div class="row justify-content-center">
                <fieldset class="col-sm-12 col-md-12 px-6">
                    <legend>Localização:</legend>
                    <div class="row">
                        <label for="" class="col-sm-2 control-label">Endereço:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="" name="ENDERECO" onkeyup="maiuscula(this)" placeholder="Nome da Rua/Sítio ou Afins">
                        </div>
                        <label for="FONE" class="col-sm-2 control-label">Fones:</label>
                        <div class="col-sm-2">
                            <input id="FONE" type="text" class="form-control" name="FONE" placeholder="XX-XXXXX-XXXX">
                        </div>
                        <div class="col-sm-2">
                            <input id="FONE_II" type="text" class="form-control" name="FONE_II" placeholder="XX-XXXXX-XXXX">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="" class="col-sm-2 control-label">Cidade</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="" name="CIDADE">
                        </div>
                        <label for="" class="col-sm-2 control-label">Estado</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="" name="CIDADE_ESTADO">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="" class="col-sm-2 control-label">Transporte</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="TRANSPORTE" id="inputTransporte">
                                <option value="NÃO">---</option>
                                <option>SIM</option>
                                <option value="NAO">NÃO</option>
                            </select>
                        </div>
                        <label for="" class="col-sm-2 control-label">Urbano/Rural</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="URBANO" id="">
                                <option checked value="SIM">Urbano</option>
                                <option value="NAO">Rural</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row" id="motoristas">
                        <label for="" class="col-sm-2  control-label">Motorista</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="MOTORISTA" id="inputMotorista">

                            </select>
                        </div>
                        <label for="" class="col-sm-2 control-label">Motorista II</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="MOTORISTA_II" id="inputMotorista2">

                            </select>
                        </div>
                    </div>
                </fieldset>
            </div>
            <br>
            <!-- Sáude  -->
            <div class="row justify-content-center">
                <fieldset class="col-sm-12 col-md-12 px-6">
                    <legend>Sáude:</legend>
                    <div class="row">
                        <label for="inputNecessidades" class="col-sm-2 control-label">Necessidasdes Especiais:</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="" name="NECESSIDADES_ESPECIAIS">
                                <option value="NAO">NÃO</option>
                                <option value="SIM">SIM</option>
                            </select>
                        </div>
                        <label for="" class="col-sm-2 control-label">Cod. da Necessidade:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="NECESSIDADES_ESPECIAIS_CODIGO" placeholder="Código da Doença">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="" class="col-sm-2 control-label">Descrição da Necessidade:</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" rows="2" id="" name="NECESSIDADES_ESPECIAIS_DESCRICACAO" placeholder="Livre para Registro de quaisquer observações"></textarea>
                        </div>
                    </div>
                </fieldset>
            </div>
            <br>
            <!-- Observações  -->
            <div class="row justify-content-center">
                <fieldset class="col-sm-12 col-md-12 px-6">
                    <legend>Observações:</legend>
                    <div class="row">
                        <div class="col-sm-12">
                            <textarea class="form-control" rows="4" id="" name="OBSERVACOES" placeholder="Livre para Registro de quaisquer observações a respeito do aluno(a)"></textarea>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="row">
                <div class="col-sm-12 ">
                    <label for="" class="col-sm-2 control-label"></label>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-outline-success btn-block " onclick="return confirmar()"><B>Salvar</B></button>
                    </div>
                </div>
            </div>
            <div style="margin-bottom: 60px;">
                <input type="hidden" id="usuario" value="{{ Auth::user()->name }}">
            </div>
        </form>
    </div>
</div>

@stop
