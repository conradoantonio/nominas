<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo_tipo_servicio" id="md-deducciones">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="titulo_tipo_servicio">Nueva deducción</h4>
            </div>
            <form enctype="multipart/form-data" action="{{url('deducciones/guardar')}}" method="POST" onsubmit="return false;" autocomplete="off" id="form-deducciones" data-ajax-type="ajax-form-modal" data-column="0" data-refresh="table" data-redirect="" data-table_id="example3" data-container_id="div_tabla_empleados">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12 hide">
                            <div class="form-group">
                                <label for="id">ID</label>
                                <input type="text" class="form-control not-empty" name="empleado_id" data-msg="ID empleado">
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="total">Monto</label>
                                <input type="text" class="form-control not-empty" name="total" data-msg="Monto">
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="num_pagos">Número de pagos</label>
                                <input type="text" class="form-control not-empty" name="num_pagos" data-msg="Número de pagos">
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="sueldo_diario_guardia">Comentarios</label>
                                <textarea class="form-control not-empty" name="comentarios" data-msg="Comentarios"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary save" id="guardar-servicio">Guardar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->