<!-- Modal -->
<div class="modal fade" id="modalFormPago" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header headerUpdate">
        <h5 class="modal-title" id="titleModal">Agregar Pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formPago" name="formPago" class="form-horizontal">
          <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>

              <div class="row">
                <div class="form-group col-md-12">
                  <label class="listCategoria">Seleccionar: Cuarto <span class="required">*</span></label>
                  <select class="form-control" data-live-search="true" id="listProductos" name="listProductos" required>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label class="control-label">Tipo de Pago <span class="required">*</span></label>
                  <select id="listtipopago" class="form-control" name="listtipopago">
                    <?php 
                      if(count($data['tiposPago']) > 0){
                        foreach ($data['tiposPago'] as $tipopago) {
                          if($tipopago['idtipopago'] != 1){
                    ?>
                      <option value="<?= $tipopago['idtipopago']?>"><?= $tipopago['tipopago']?></option>
                    <?php
                          }
                        }
                      }
                    ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                  <label class="control-label">Mes de pago <span class="required">*</span></label>
                    <div class="input-group date" id="fechaPago">
                      <!-- <input class="form-control date-picker pagoMes" id="txtFechaPago" name="txtFechaPago" onkeydown="return false"  placeholder="Año y Mes"> -->
                      <input class="form-control date-picker" id="txtFechaPago" name="txtFechaPago" onkeydown="return false" placeholder="Mes de pago"/><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-calendar"></i></span></span>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <button id="btnActionForm" class="btn btn-info btn-lg btn-block" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Agregar</span></button>
                </div>
                <div class="form-group col-md-6">
                  <button  class="btn btn-danger btn-lg btn-block" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
                </div>
              </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>