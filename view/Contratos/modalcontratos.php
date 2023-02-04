<div id="modalcontratos" class="modal fade bd-example-modal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="font-icon-close-2"></i>
                </button>
                <h4 class="modal-title">Editar Contrato</h4>
            </div>
            <form method="post" id="contratos_form_modal">
                <div class="modal-body">

                    <input type="hidden" name="contrat_id" id="contrat_id">

                    <div class="form-group">
                        <label class="form-label semibold" for="client_id">Cliente</label>
                        <select name="client_id" id="client_id">

                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label semibold" for="servicios">Servicio a pagar</label>
                        <select id="servicios" name="servicios[]" class="form-control" multiple></select>
                        <span class="text-danger d-none mensaje">Se debe seleccionar al menos un servicio</span>
                    </div>

                    <div class="form-group">
                        <label class="form-label semibold" for="contrato_plan">Tipo de contrato</label>
                        <select class="form-control" name="contrato_plan" id="contrato_plan">
                            <option value="">Seleccione un tipo de contrato
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label semibold" for="tip_per">Tipo de empresa</label>
                        <input type="text" class="form-control" id="tip_per" name="tip_per"
                            placeholder="Tipo de empresa" readonly>
                    </div>


                    <div class="form-group">
                        <label class="form-label semibold" for="nom_emp">Nombre de la empresa</label>
                        <input type="text" class="form-control" id="nom_emp" name="nom_emp" placeholder="Nombre"
                            readonly>
                    </div>


                    <div class="form-group">
                        <label class="form-label semibold" for="doc_nac">Documento de identidad o RIF</label>
                        <input type="text" class="form-control" id="doc_nac" name="doc_nac" placeholder="RIF" readonly>
                    </div>

                    <div class="form-group">
                        <label class="form-label semibold" for="cost_serv">Costo del servicio</label>
                        <input type="number" class="form-control" id="cost_serv" name="cost_serv"
                            placeholder="Monto a pagar" readonly>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" id="#" value="add"
                        class="btn btn-rounded btn-primary">Editar</button>
                </div>
            </form>
        </div>
    </div>
</div>