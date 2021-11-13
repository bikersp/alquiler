    <!-- Modal Agregar Usuario-->
    <div class="modal fade" id="modalFormMensaje" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header headerRegister">
            <h5 class="modal-title" id="titleModal">Nuevo Mensaje</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="frmMensaje" name="frmMensaje" class="form-horizontal">
              <p class="text-primary">Todos los campos son obligatorios</p>

              <div class="form-row">
                <div class="form-group col-sm-12">
                  <label class="control-label">Asunto</label>
                  <input class="form-control"  id="nombreContacto" name="nombreContacto" placeholder="" type="text" required>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-sm-12">
                  <label class="control-label">Mensaje</label>
                  <input class="form-control" type="hidden" id="emailContacto" name="emailContacto" placeholder="" value="<?php echo $_SESSION['userData']['nombres'] ?>">
                  <textarea class="form-control" id="mensaje" name="mensaje" placeholder=""></textarea>
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