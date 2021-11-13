<?php
  header_Admin($data);
  getModal('modalPago', $data);
?>
<style>.ui-datepicker-calendar {display: none;}</style>

<div id="divModal"></div>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1>
        <i class="fa fa-box"></i> <?= $data['page_title']; ?>
        <?php if ($_SESSION['permisosMod']['w']) { ?>
        <button class="btn btn-primary" type="button" onclick="openModal();"><i class="fas fa-plus-circle mr-1"></i> Agregar Pago</button>
        <?php } ?>
      </h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?= base_url();?>/pedidos"><?= $data['page_name']; ?></a></li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <h4>Pagos Recientes</h4>
          <hr>
          <div class="table-responsive">
            <table class="table table-sm table-hover table-bordered table-fix" id="tablePedidos">
              <thead>
                <tr class="bg-primary text-white">
                  <th>ID</th>
                  <th>Cobrador</th>
                  <th>Inquilino</th>
                  <th>Cuarto</th>
                  <th>Piso</th>
                  <th>Monto</th>
                  <th>Tipo pago</th>
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
    <div class="col-md-12">
      <div class="row">
        <div class="col-lg-6">
          <div class="tile">
            <div class="tile-body">
              <h4>Pagos del mes actual - <?php $mes = intval(date("m"));$meses = Meses(); echo $meses[$mes-1];?></h4>
              <hr>
              <div class="table-responsive">
                <table class="table table-sm table-hover table-bordered table-fix" id="tableDeudores">
                  <thead>
                    <tr class="bg-primary text-white">
                      <th>Inquilino</th>
                      <th>Cuarto</th>
                      <th>Día de pago</th>
                      <th>Pagó?</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="tile">
            <div class="tile-body">
              <h4>Pagos del mes anterior - <?php $mes = intval(date("m"));$meses = Meses(); echo $meses[$mes-2];?></h4>
              <hr>
              <div class="table-responsive">
                <table class="table table-sm table-hover table-bordered table-fix" id="tableDeudores2">
                  <thead>
                    <tr class="bg-primary text-white">
                      <th>Inquilino</th>
                      <th>Cuarto</th>
                      <th>Día de pago</th>
                      <th>Pagó?</th>
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
    </div>
    <div class="col-lg-6">
      <div class="tile">
        <div class="tile-body">
          <h4>Contratos por vencer</h4>
          <hr>
          <div class="table-responsive">
            <table class="table table-sm table-hover table-bordered" id="tableContratos">
              <thead>
                <tr class="bg-primary text-white">
                  <th>Inquilino</th>
                  <th>Cuarto</th>
                  <th>Fecha fin Contrato</th>
                  <th>Venció?</th>
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

</main>
<?php footer_Admin($data); ?>