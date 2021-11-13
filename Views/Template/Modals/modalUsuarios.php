    <!-- Modal Agregar Usuario-->
    <div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header headerRegister">
            <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formUsuario" name="formUsuario" class="form-horizontal">
              <input type="hidden" id="idUsuario" name="idUsuario" value="">
              <p class="text-primary">Todos los campos son obligatorios</p>

              <div class="form-row">
                <div class="form-group col-sm-6">
                  <label class="control-label">Identificación</label>
                  <input class="form-control" id="txtIdentificacion" name="txtIdentificacion" type="text" required>
                </div>
                <div class="form-group col-sm-6">
                  <label class="control-label">Tipo Usuario</label>
                  <select class="form-control" data-live-search="true" id="listRolid" name="listRolid" required>
                  </select>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label class="control-label">Nombres</label>
                  <input class="form-control valid validText" id="txtNombre" name="txtNombre" type="text" required>
                </div>
                <div class="form-group col-md-6">
                  <label class="control-label">Apellidos</label>
                  <input class="form-control valid validText" id="txtApellido" name="txtApellido" type="text" required>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-sm-6">
                  <label class="control-label">Teléfono</label>
                  <input class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" type="text" required onkeypress="return controlTag(event);">
                </div>
                <div class="form-group col-sm-6">
                  <label class="control-label">Email</label>
                  <input class="form-control valid validEmail" id="txtEmail" name="txtEmail" type="text" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-sm-6">
                  <label for="exampleSelect1">Status</label>
                  <select class="form-control selectpicker" id="listStatus" name="listStatus" required>
                    <option value="1">Activo</option>
                    <option value="2">Inactivo</option>
                  </select>
                </div>
                <div class="form-group col-sm-6">
                  <label class="control-label">Password</label>
                  <input class="form-control" id="txtPassword" name="txtPassword" type="password">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-sm-6">
                  <label class="control-label">Cuentas Bancarias</label>
                  <textarea class="form-control" id="txtCuentas" name="txtCuentas"></textarea>
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

    <!-- Modal Ver Usuario-->
    <div class="modal fade" id="modalViewUser" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header header-primary">
            <h5 class="modal-title" id="titleModal">Datos del Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td>Identificación:</td>
                  <td id="celIdentificacion"></td>
                </tr>
                <tr>
                  <td>Nombres:</td>
                  <td id="celNombre"></td>
                </tr>
                <tr>
                  <td>Apellidos:</td>
                  <td id="celApellido"></td>
                </tr>
                <tr>
                  <td>Teléfono:</td>
                  <td id="celTelefono"></td>
                </tr>
                <tr>
                  <td>Email (Usuario):</td>
                  <td id="celEmail"></td>
                </tr>
                <tr>
                  <td>Tipo Usuario:</td>
                  <td id="celTipoUsuario"></td>
                </tr>
                <tr>
                  <td>Estado:</td>
                  <td id="celEstado"></td>
                </tr>
                <tr>
                  <td>Cuenas Bancarias:</td>
                  <td id="celCuentas"></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

