    <!-- Modal -->
    <div class="modal fade" id="modalFormCategorias" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header headerUpdate">
            <h5 class="modal-title" id="titleModal">Nuevo Cuarto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formCategorias" name="formCategorias" class="form-horizontal">
              <input type="hidden" id="idCategoria" name="idCategoria" value="">
              <input type="hidden" id="foto_actual" name="foto_actual" value="">
              <input type="hidden" id="foto_remove" name="foto_remove" value="0">
              <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>

              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Nombre del Cuarto <span class="required">*</span></label>
                    <input class="form-control valid" id="txtNombre" name="txtNombre" autofocus type="text" placeholder="Nombre del Cuarto" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Piso <span class="required">*</span></label>
                    <textarea class="form-control valid" id="txtDescripcion" name="txtDescripcion" rows="2" placeholder="Nombre del Piso" required></textarea>
                  </div>
                  <div class="row">
                    <!-- <div class="form-group col-md-6">
                      <div class="form-group">
                        <label for="exampleSelect1">Estado <span class="required">*</span></label>
                        <select class="form-control selectpicker" id="listStatus" name="listStatus">
                          <option value="1">Activo</option>
                          <option value="2">Inactivo</option>
                        </select>
                      </div>
                    </div> -->
                    <div class="form-group col-md-6">
                      <label class="control-label">Precio <span class="required">*</span></label>
                      <input class="form-control valid" id="txtPrecio" name="txtPrecio" type="text" required>
                      <input class="form-control" type="hidden" name="listStatus" id="listStatus" value="1">
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <div class="photo">
                    <label for="foto">Foto (570x380)</label>
                    <div class="prevPhoto">
                      <span class="delPhoto notBlock">X</span>
                      <label for="foto"></label>
                      <div>
                        <img id="img" src="<?= media(); ?>/img/uploads/portada.png">
                      </div>
                    </div>
                    <div class="upimg">
                      <input type="file" name="foto" id="foto">
                    </div>
                    <div id="form_alert"></div>
                  </div>
                </div>
              </div>

              <div class="tile-footer">
                <button id="btnActionForm" class="btn btn-info" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;

                 <button  class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Ver Categoria-->
    <div class="modal fade" id="modalViewCategoria" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header header-primary">
            <h5 class="modal-title" id="titleModal">Datos del Cuarto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td>Cuarto:</td>
                  <td id="celNombre"></td>
                </tr>
                <tr>
                  <td>Piso:</td>
                  <td id="celDescripcion"></td>
                </tr>
                <tr>
                  <td>Alquiler:</td>
                  <td id="celPrecio"></td>
                </tr>
                <tr>
                  <td>Foto</td>
                  <td id="imgCategoria"></td>
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