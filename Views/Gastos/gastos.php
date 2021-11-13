<?php
  header_Admin($data);
  getModal('modalGasto', $data);
?>
<style>.ui-datepicker-calendar {display: none;}</style>

  <main class="app-content">
      <div class="app-title">
        <div>
            <h1>
              <i class="fa fa-user-tag"></i> <?= $data['page_title']; ?>
              <?php if ($_SESSION['permisosMod']['w']) { ?>
              <button class="btn btn-primary" type="button" onclick="openModal();"><i class="fas fa-plus-circle mr-1"></i> Nuevo Gasto</button>
              <?php } ?>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/contactos"><?= $data['page_name'] ?></a></li>
        </ul>
      </div>

      <div class="row">
          <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
                <div class="table-responsive">
                  <table class="table table-sm table-hover table-bordered table-fix" id="tableGastos">
                    <thead>
                      <tr class="bg-primary text-white">
                        <th>ID</th>
                        <th>Servicio</th>
                        <th>Descripción</th>
                        <th>Monto</th>
                        <th>Fecha pagada</th>
                        <th>Mes de pago</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
      </div>
      
      <div class="row">
        <div class="col-lg-6">
          <div class="tile">
            <div class="tile-body">
              <table class="table table-sm table-hover table-bordered">
                <thead>
                  <tr class="bg-primary text-white">
                    <td colspan="2" align="center"><i class="fas fa-tint"></i> <b>Agua</b></td>
                  </tr>
                  <tr>
                    <td>Numero de Suministro</td>
                    <td>64564564</td>
                  </tr>
                  <tr>
                    <td>Fecha de Pago</td>
                    <td>20 de cada mes</td>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="tile">
            <div class="tile-body">
              <table class="table table-sm table-hover table-bordered">
                <thead>
                  <tr class="bg-primary text-white">
                    <td colspan="2" align="center"><i class="fas fa-lightbulb"></i> <b>Luz</b></td>
                  </tr>
                  <tr>
                    <td>Numero de Suministro</td>
                    <td>64564564</td>
                  </tr>
                  <tr>
                    <td>Fecha de Pago</td>
                    <td>20 de cada mes</td>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

    </main>
<?php footer_Admin($data); ?>