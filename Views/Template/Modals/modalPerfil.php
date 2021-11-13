    <!-- Modal -->
    <div class="modal fade" id="modalFormPerfil" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header headerUpdate">
            <h5 class="modal-title" id="titleModal">Actualizar Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formPerfil" name="formPerfil" class="form-horizontal">
              <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>

              <div class="form-row">
                <div class="form-group col-sm-6">
                  <label class="control-label">Identificación <span class="required">*</span></label>
                  <input class="form-control" id="txtIdentificacion" name="txtIdentificacion" type="text" value="<?= $_SESSION['userData']['identificacion']; ?>" required>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label class="control-label">Nombres <span class="required">*</span></label>
                  <input class="form-control" id="txtNombre" name="txtNombre" type="text" value="<?= $_SESSION['userData']['nombres']; ?>" required>
                </div>
                <div class="form-group col-md-6">
                  <label class="control-label">Apellidos <span class="required">*</span></label>
                  <input class="form-control" id="txtApellido" name="txtApellido" type="text" value="<?= $_SESSION['userData']['apellidos']; ?>" required>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-sm-6">
                  <label class="control-label">Teléfono</label>
                  <input class="form-control" id="txtTelefono" name="txtTelefono" type="text" value="<?= $_SESSION['userData']['telefono']; ?>" required onkeypress="return controlTag(event);">
                </div>
                <div class="form-group col-sm-6">
                  <label class="control-label">Email</label>
                  <input class="form-control" id="txtEmail" name="txtEmail" type="text" value="<?= $_SESSION['userData']['email_user']; ?>" required readonly disabled>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-sm-6">
                  <label class="control-label">Password</label>
                  <input class="form-control" id="txtPassword" name="txtPassword" type="password">
                </div>
                <div class="form-group col-sm-6">
                  <label class="control-label">Confirmar Password</label>
                  <input class="form-control" id="txtPasswordConfirm" name="txtPasswordConfirm" type="password">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-sm-6">
                  <label class="control-label">Cuentas Bancarias</label>
                  <textarea class="form-control" id="txtCuentas" name="txtCuentas"><?= $_SESSION['userData']['cuentas']; ?></textarea>
                </div>
              </div>

              <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-info" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Actualizar</span></button>&nbsp;&nbsp;&nbsp;

                 <button  class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>