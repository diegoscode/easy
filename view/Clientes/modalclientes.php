<div id="modalclientes" class="modal fade bd-example-modal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="font-icon-close-2"></i>
                </button>
                <h4 class="modal-title" id="mdclientes"></h4>
            </div>
            <form method="post" id="clientes_form">
                <div class="modal-body">

                    <input type="hidden" class="form-control" id="client_id" name="client_id">

                    <div class="form-group">
                        <label class="form-label semibold" for="nom_emp">Cliente</label>
                        <input type="text" class="form-control" id="nom_emp" name="nom_emp" placeholder="Nombre"
                            required>
                    </div>

                    <div class="form-group">
                        <label class="form-label semibold" for="doc_nac">Documento de identidad o RIF</label>
                        <input type="text" class="form-control" id="doc_nac" name="doc_nac"
                            placeholder="Documento de identidad" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label semibold" for="tip_per">Tipo de empresa o particular</label>
                        <input type="text" class="form-control" id="tip_per" name="tip_per" placeholder="Tipo" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label semibold" for="direccion">Direccion</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion"
                            required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" id="#" value="add"
                        class="btn btn-rounded btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>