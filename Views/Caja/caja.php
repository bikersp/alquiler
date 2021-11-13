<?php
  header_Admin($data);
  // getModal('modalGasto', $data);
?>
  <main class="app-content">
      <div class="app-title">
        <div>
            <h1>
              <i class="fa fa-user-tag"></i> <?= $data['page_title']; ?>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/contactos"><?= $data['page_name'] ?></a></li>
        </ul>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="tile">
            <div class="tile-body">
              <p><b>Cuenta Mancomunada (BCP):</b> 3284923842-234234-23423</p>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <div class="tile">
            <div class="tile-body">
              <h4>Datos del mes actual - <?php $mes = intval(date("m"));$meses = Meses(); echo $meses[$mes-1];?></h4>
              <div class="table-responsive mt-4">
                <table class="table table-sm table-hover">
                  <thead>
                    <tr>
                      <td><b>Ingresos del mes:</b></td>
                      <td align="right"><?= SMONEY.formatMoney($data['pagosMes']['total'])?></td>
                    </tr>
                    <tr>
                      <td><b>Gastos de servicios:</b></td>
                      <td align="right">- <?= SMONEY.formatMoney($data['gastosMes']['total'])?></td>
                    </tr>
                    <tr>
                      <td><b>Deposito a caja:</b></td>
                      <td align="right">- <?= SMONEY.formatMoney($data['cajaMes']['total'])?></td>
                    </tr>
                    <tr>
                      <td><b>Total:</b></td>
                      <td align="right"><b class="text-success"><?= SMONEY.formatMoney(($data['pagosMes']['total']-($data['gastosMes']['total']+$data['cajaMes']['total'])))?></b></td>
                    </tr>
                  </thead>
                </table>
              </div>
              <p><small>Otros gastos: <?= SMONEY.formatMoney($data['gastosOtros']['total'])?></small></p>
              <b class="text-info">Reparto dividido en 5: <span class="ml-2"><?= SMONEY.formatMoney(($data['pagosMes']['total']-($data['gastosMes']['total']+$data['cajaMes']['total']))/5)?></span></b>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="tile">
            <div class="tile-body">
              <h4>Datos del mes anterior - <?php $mes = intval(date('m', strtotime('-1 month'))); $meses = Meses(); echo $meses[$mes-1];?></h4>
              <div class="table-responsive mt-4">
                <table class="table table-sm table-hover">
                  <thead>
                    <tr>
                      <td><b>Ingresos del mes:</b></td>
                      <td align="right"><?= SMONEY.formatMoney($data['pagosMesAnterior']['total'])?></td>
                    </tr>
                    <tr>
                      <td><b>Gastos de servicios:</b></td>
                      <td align="right">- <?= SMONEY.formatMoney($data['gastosMesAnterior']['total'])?></td>
                    </tr>
                    <!-- <tr>
                      <td><b>Otros gastos:</b></td>
                      <td align="right"><?= SMONEY.formatMoney($data['gastosOtrosAnterior']['total'])?></td>
                    </tr> -->
                    <tr>
                      <td><b>Deposito a caja:</b></td>
                      <td align="right">- <?= SMONEY.formatMoney($data['cajaMesAnterior']['total'])?></td>
                    </tr>
                    <tr>
                      <td><b>Total:</b></td>
                      <td align="right"><b class="text-success"><?= SMONEY.formatMoney(($data['pagosMesAnterior']['total']-($data['gastosMesAnterior']['total']+$data['cajaMesAnterior']['total'])))?></b></td>
                    </tr>
                  </thead>
                </table>
              </div>
              <p><small>Otros gastos: <?= SMONEY.formatMoney($data['cajaMesAnterior']['total'])?></small></p>
              <b class="text-info">Reparto dividido en 5: <span class="ml-2"><?= SMONEY.formatMoney(($data['pagosMesAnterior']['total']-($data['gastosMesAnterior']['total']+$data['cajaMesAnterior']['total']))/5)?></span></b>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="tile">
            <div class="tile-body">
              <h4>Caja Manconumada</h4>
              <div class="table-responsive mt-4">
                <table class="table table-sm table-hover">
                  <thead>
                    <tr>
                      <td><b>Total acumulado:</b></td>
                      <td align="right"><b class="text-success"><?= SMONEY.formatMoney(($data['caja']['total']-$data['otro']['total']))?></b></td>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
<?php footer_Admin($data); ?>