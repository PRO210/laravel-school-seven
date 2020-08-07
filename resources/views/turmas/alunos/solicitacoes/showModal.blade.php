<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!--  <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                <h4 class="modal-title">Atualizar Pedido</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-sm-3">
                            <label for="" class="control-label">Requerente</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" placeholder="ALTERE O NOME DO REQUERENTE SE DESEJAR" class="form-control" name="SOLICITANTE" id="SOLICITANTE" onkeyup="maiuscula(this)">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="" class="control-label">Status da Transferência</label>
                        </div>
                        <div class="col-sm-9">
                            <select name="TRANSFERENCIA_STATUS" class="form-control" id="TRANSFERENCIA_STATUS">
                                <option value="ENTREGUE">ENTREGUE</option>
                                <option value="PRONTA">PRONTA</option>
                                <option value="PENDENTE">PENDENTE</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="" class="control-label" id="">Entrega ou Pronta</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="DATA_TRANSFERENCIA_STATUS" id="DATA_TRANSFERENCIA_STATUS">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="" class="control-label">Declaração</label>
                        </div>
                        <div class="col-sm-9">
                            <select class="form-control" name="DECLARACAO" id="DECLARACAO">
                                <option value="NAO">NAO</option>
                                <option value="SIM">SIM</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="" class="control-label">Responsável/Parente</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" placeholder="DIGITE O NOME DO RESPONSÁVEL" class="form-control" id="RESPONSAVEL_DECLARACAO" name="RESPONSAVEL_DECLARACAO" value="" onkeyup="maiuscula(this)">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="" class="control-label">Data Declaração</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="DATA_DECLARACAO" id="DATA_DECLARACAO">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="" class="control-label">Transferência</label>
                        </div>
                        <div class="col-sm-9">
                            <select class="form-control" name="TRANSFERENCIA" id="TRANSFERENCIA">
                                <option value="NAO">NAO</option>
                                <option value="SIM">SIM</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="" class="control-label">Responsável/Parente</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" placeholder="DIGITE O NOME DO RESPONSÁVEL" class="form-control" id="RESPONSAVEL_TRANSFERENCIA" name="RESPONSAVEL_TRANSFERENCIA" onkeyup="maiuscula(this)">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="" class="control-label" id="">Data Transferência</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="DATA_TRANSFERENCIA" id="DATA_TRANSFERENCIA">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="" class="control-label">Status Atual do Aluno</label>
                        </div>
                        <div class="col-sm-9">
                            <select class="form-control" name="classificacao_id" id="classificacao_id" >

                                <option value="0" disabled="">ESCOLHA UMA DAS OPÇÕES ABAIXO</option>
                                <option value="1">CURSANDO</option>
                                <option value="2">ADIMITIDO DEPOIS</option>
                                <option value="3">TRANSFERIDO</option>
                                <option value="4">DESISTENTE</option>
                                <option value="8" >ARQUIVADO</option>
                                <option value="9" disabled="">APROVADO</option>
                                <option value="10" disabled="">REPROVADO</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6">
                            <button type="submit" name="botao" value="unico" class="btn btn-success btn-block" onclick="return confirmar()">Salvar as Alterações </button>
                        </div>
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-warning btn-block" data-dismiss="modal">Voltar para as Solicitações</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal  Arquivo Passivo-->
<div class="modal fade" id="myModal_02" role="dialog" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!--  <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="" class="control-label">Pastas</label>
                        </div>
                        <div class="col-sm-9">
                            <select class="form-control" name="EXCLUIDO_PASTA" id="EXCLUIDO_PASTA">
                                @foreach($arquivo_passivo as $pastas)
                                <option value="{{$pastas}}">{{$pastas}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6">
                            <button type="submit" name="botao" value="arquivo_passivo" id="arquivo_passivo" class="btn btn-success btn-block" onclick="return confirmar()" disabled title="Marque ao menos uma das caixinhas">Salvar as Alterações </button>
                        </div>
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-warning btn-block" data-dismiss="modal">Voltar para as Solicitações</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>
