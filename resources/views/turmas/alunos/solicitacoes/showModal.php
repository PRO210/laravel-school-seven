<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                        <div class="form-group col-sm-12">
                            <label for="" class="col-sm-4 control-label">Declaração</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="DECLARACAO" id="DECLARACAO">
                                    <option value="NAO">NAO</option>
                                    <option value="SIM">SIM</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="inputRD" class="col-sm-4 control-label">Responsável pela Declaração</label>
                            <div class="col-sm-8">
                                <input type="text" placeholder="DIGITE O NOME DO RESPONSÁVEL" class="form-control" id="RESPONSAVEL_DECLARACAO" name="RESPONSAVEL_DECLARACAO" value="" onkeyup="maiuscula(this)">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="" class="col-sm-4 control-label">Data Declaração</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" name="DATA_DECLARACAO" id="DATA_DECLARACAO">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="" class="col-sm-4 control-label">Transferência</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="TRANSFERENCIA" id="TRANSFERENCIA">
                                    <option value="NAO">NAO</option>
                                    <option value="SIM">SIM</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="" class="col-sm-4 control-label">Responsável pela Transferência</label>
                            <div class="col-sm-8">
                                <input type="text" placeholder="DIGITE O NOME DO RESPONSÁVEL" class="form-control" id="RESPONSAVEL_TRANSFERENCIA" name="RESPONSAVEL_TRANSFERENCIA" onkeyup="maiuscula(this)">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="" class="col-sm-4 control-label" id="">Data Transferência</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" name="DATA_TRANSFERENCIA" id="DATA_TRANSFERENCIA">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="" class="col-sm-4 control-label">Status Atual do Aluno</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="aluno_classificacao_id" id="aluno_classificacaos_id">
                                    <option value="0" disabled="">ESCOLHA UMA DAS OPÇÕES ABAIXO</option>
                                    <option value="1" disabled="">APROVADO</option>
                                    <option value="2">CURSANDO</option>
                                    <option value="3">DESISTENTE</option>
                                    <option value="4">ADIMITIDO DEPOIS</option>
                                    <option value="5">TRANSFERIDO</option>
                                    <option value="6" disabled="">REPROVADO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="botao" value="unico" class="btn btn-success btn-block" onclick="return confirmar()">Salvar as Alterações </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Voltar para as Solicitações</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
