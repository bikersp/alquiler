    <!-- Modal Agregar Usuario-->
    <div class="modal fade" id="modalFormGasto" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header headerRegister">
            <h5 class="modal-title" id="titleModal">Nuevo Gasto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="frmGasto" name="frmGasto" class="form-horizontal">
              <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>

              <div class="form-row">
                <div class="form-group col-sm-12">
                  <label class="control-label">Servicio <span class="required">*</span></label>
                  <!-- <input class="form-control"  id="txtServicio" name="txtServicio" placeholder="ejem: Luz" type="text" required> -->
                  <select id="txtServicio" class="form-control" name="txtServicio">
                    <option value="1">Luz</option>
                    <option value="2">Agua</option>
                    <option value="3">Caja</option>
                    <option value="4">Otro</option>
                  </select>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-sm-12">
                  <label class="control-label">Descripción</label>
                  <textarea class="form-control" id="mensaje" name="mensaje" placeholder=""></textarea>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-sm-12">
                  <label class="control-label">Monto <span class="required">*</span></label>
                  <input class="form-control"  id="monto" name="monto" placeholder="ejem: 100.50" type="text" required>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-sm-12">
                  <label class="control-label">Mes de pago <span class="required">*</span></label>
                  <div class="input-group date" id="fechaPago">
                    <input class="form-control date-picker" id="txtFechaPago" name="txtFechaPago" onkeydown="return false" placeholder="Mes de Pago"/><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-calendar"></i></span></span>
                  </div>
                </div>
              </div>

              <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;

                 <button  class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>