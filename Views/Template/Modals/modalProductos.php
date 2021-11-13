    <!-- Modal -->
    <div class="modal fade" id="modalFormProductos" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header headerUpdate">
            <h5 class="modal-title" id="titleModal">Nuevo Inquilino</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formProductos" name="formProductos" class="form-horizontal">
              <input type="hidden" id="idProducto" name="idProducto" value="">
              <p class="text-primary">Los campos con asterisco (<span class="required">*</span>) son obligatorios.</p>

              <div class="row">
                <div class="col-lg-6 col-xl-7">
                  <div class="form-group">
                    <label class="control-label">Nombres <span class="required">*</span></label>
                    <input class="form-control valid" id="txtNombre" name="txtNombre" type="text" placeholder="Nombres del Inquilino" required>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Observaciones </label>
                    <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" ></textarea>
                  </div>
                </div>
                <div class="col-lg-6 col-xl-5">
                  <div class="form-group">
                    <label class="control-label">Identificación <span class="required">*</span></label>
                    <input class="form-control valid" id="txtCodigo" name="txtCodigo" type="text" placeholder="Documento de identidad" required>
                    <!-- <br>
                    <div id="divBarCode" class="notblock text-center">
                      <div id="printCode">
                        <svg id="barcode"></svg>
                      </div>
                      <button class="btn btn-success btn-sm" type="button" onclick="fntPrintBarcode('#printCode');"><i class="fas fa-print"></i> Imprimir</button>
                    </div> -->
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label class="listCategoria">Cuarto <span class="required">*</span></label>
                      <select class="form-control" data-live-search="true" id="listCategoria" name="listCategoria" required>
                      </select>
                      <input class="form-control" type="hidden" name="listStatus" id="listStatus" value="1">
                    </div>
                    <div class="form-group col-md-6">
                      <label class="control-label">Teléfono</label>
                      <input class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" type="text" onkeypress="return controlTag(event);">
                    </div>
                    <!-- <div class="form-group col-md-6">
                      <label for="listStatus">Estado <span class="required">*</span></label>
                      <select class="form-control selectpicker" id="listStatus" name="listStatus" required>
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                      </select>
                    </div> -->
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label class="control-label">Alquiler <span class="required">*</span></label>
                      <input class="form-control valid" id="txtPrecio" name="txtPrecio" type="text" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="control-label">Personas <span class="required">*</span></label>
                      <input class="form-control valid validNumber" id="txtStock" name="txtStock" type="text" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label class="control-label">Fecha: <small>Inicio de Contrato</small> <span class="required">*</span></label>
                      <div class="input-group date" id="fechainicio">
                        <input class="form-control date-picker" id="txtFechaI" name="txtFechaI" readonly onkeydown="return false" placeholder="Fecha inicio"/><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-calendar"></i></span></span>
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="control-label">Fecha: <small>Fin de Contrato</small> <span class="required">*</span></label>
                      <div class="input-group date" id="fechafin">
                        <input class="form-control date-picker" id="txtFechaF" name="txtFechaF" readonly onkeydown="return false" placeholder="Fecha fin"/><span class="input-group-append input-group-addon"><span class="input-group-text"><i class="fa fa-calendar"></i></span></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <button id="btnActionForm" class="btn btn-info btn-lg btn-block" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>
                    </div>
                    <div class="form-group col-md-6">
                      <button  class="btn btn-danger btn-lg btn-block" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tile-footer">
                <div class="form-group col-md-12">
                  <div id="containerGallery">
                    <span>Agregar foto (440 x 545)</span>
                    <button class="btnAddImage btn btn-info btn-sm" type="button"><i class="fas fa-plus"></i></button>
                  </div>
                  <hr>
                  <div id="containerImages">
                    <!-- <div id="div24">
                      <div class="prevImage">
                        <img src="<?= media(); ?>/img/uploads/portada.png">
                      </div>
                      <input type="file" name="foto" id="img1" class="inputUploadfile">
                      <label for="img1" class="btnUploadfile"><i class="fas fa-upload "></i></label>
                      <button class="btnDeleteImage" type="button" onclick="fntDelItem('div24')"><i class="fas fa-trash-alt"></i></button>
                    </div>
                    <div id="div24">
                      <div class="prevImage">
                        <img class="loading" src="<?= media(); ?>/img/icon/loading.svg">
                      </div>
                      <input type="file" name="foto" id="img1" class="inputUploadfile">
                      <label for="img1" class="btnUploadfile"><i class="fas fa-upload "></i></label>
                      <button class="btnDeleteImage" type="button" onclick="fntDelItem('div24')"><i class="fas fa-trash-alt"></i></button>
                     </div>  -->
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal View-->
    <div class="modal fade" id="modalViewProducto" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" >
        <div class="modal-content">
          <div class="modal-header header-primary">
            <h5 class="modal-title" id="titleModal">Datos del Inquilino</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td>Identificación:</td>
                  <td id="celCodigo"></td>
                </tr>
                <tr>
                  <td>Nombres:</td>
                  <td id="celNombre"></td>
                </tr>
                <tr>
                  <td>Cuarto:</td>
                  <td id="celCategoria"></td>
                </tr>
                <tr>
                  <td>Piso:</td>
                  <td id="celPiso"></td>
                </tr>
                <tr>
                  <td>Alquiler:</td>
                  <td id="celPrecio"></td>
                </tr>
                <tr>
                  <td>Teléfono:</td>
                  <td id="celTelefono"></td>
                </tr>
                <tr>
                  <td>Observaciones:</td>
                  <td id="celDescripcion"></td>
                </tr>
                <tr>
                  <td>Personas:</td>
                  <td id="celStock"></td>
                </tr>
                <tr>
                  <td>Fecha Inicio Contrato:</td>
                  <td id="celFechaI"></td>
                </tr>
                <tr>
                  <td>Fecha Fin Contrato:</td>
                  <td id="celFechaF"></td>
                </tr>
                <!-- <tr>
                  <td>Estado:</td>
                  <td id="celStatus"></td>
                </tr> -->
                <tr>
                  <td>Fotos:</td>
                  <td id="celFotos">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>