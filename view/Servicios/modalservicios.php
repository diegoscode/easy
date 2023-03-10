<div id="modalservicios" class="modal fade bd-example-modal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="font-icon-close-2"></i>
                </button>
                <h4 class="modal-title" id="mdservicios"></h4>
            </div>
            <form method="post" id="servicios_form">
                <div class="modal-body">

                    <input type="hidden" class="form-control" id="num_serv" name="num_serv">
                    
                    <div class="form-group">
                        <label class="form-label semibold" for="tip_serv">Servicio</label>
                        <input type="text" class="form-control" id="tip_serv" name="tip_serv" placeholder="Servicio"
                            required>
                    </div>

                    <div class="form-group">
                        <label class="form-label semibold" for="cat_serv">Categoria</label>
                        <input type="text" class="form-control" id="cat_serv" name="cat_serv" placeholder="Categoria"
                            required>
                    </div>

                    <div class="form-group">
                        <label class="form-label semibold" for="sub_cat">Sub-Categoria</label>
                        <input type="text" class="form-control" id="sub_cat" name="sub_cat" placeholder="Sub Categoria"
                            required>
                    </div>

                    <div class="form-group">
                        <label class="form-label semibold" for="cost_serv">Costo de Servicio</label>
                        <input type="number" class="form-control" id="cost_serv" name="cost_serv" placeholder="Costo"
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