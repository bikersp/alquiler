    <?php header_Admin($data); ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> <?= $data['page_title']; ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url();?>/dashboard">Dashboard</a></li>
        </ul>
      </div>

       <div class="row">
        <?php if (!empty($_SESSION['permisos'][2]['r'])) {?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url() ?>/usuarios" class="link-w">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Usuarios</h4>
                <p><b><?= $data['usuarios'] ?></b></p>
              </div>
            </div>
          </a>
        </div>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][3]['r'])) {?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url() ?>/clientes" class="link-w">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-user fa-3x"></i>
              <div class="info">
                <h4>Clientes</h4>
                <p><b><?= $data['clientes'] ?></b></p>
              </div>
            </div>
          </a>
        </div>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][3]['r'])) {?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url() ?>/productos" class="link-w">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-archive fa-3x"></i>
              <div class="info">
                <h4>Productos</h4>
                <p><b><?= $data['productos'] ?></b></p>
              </div>
            </div>
          </a>
        </div>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][5]['r'])) {?>
        <div class="col-md-6 col-lg-3">
          <a href="<?= base_url() ?>/pedidos" class="link-w">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-shopping-cart fa-3x"></i>
              <div class="info">
                <h4>Pedidos</h4>
                <p><b><?= $data['pedidos'] ?></b></p>
              </div>
            </div>
          </a>
        </div>
        <?php } ?>
        <!-- </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
            <div class="info">
              <h4>Likes</h4>
              <p><b>25</b></p>
            </div>
          </div>
        </div> -->
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
        <?php if (!empty($_SESSION['permisos'][5]['r'])) {?>
          <div class="tile">
            <h3 class="tile-title">Últimos Pedidos</h3>
            <table class="table table-striped table-sm">
              <thead>
                <tr class="bg-primary text-white">
                  <th>#</th>
                  <th>Cliente</th>
                  <th>Estado</th>
                  <th>Monto</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if(count($data['lastOrders']) > 0) {
                    foreach ($data['lastOrders'] as $pedido) {
                ?>
                <tr>
                  <td><?= $pedido['idpedido'] ?></td>
                  <td><?= $pedido['nombre'] ?></td>
                  <td><?= $pedido['status'] ?></td>
                  <td class="text-right"><?= SMONEY.formatMoney($pedido['monto']) ?></td>
                  <td><a href="<?= base_url() ?>/pedidos/orden/<?= $pedido['idpedido'] ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                </tr>
                <?php } } ?>
              </tbody>
            </table>
          </div>
        <?php } ?>
        </div>

        <div class="col-md-6">
          <div class="tile">
            <div class="container-title">
              <h3 class="tile-title">Últimos productos</h3>
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Monto</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    if(count($data['productosTen']) > 0) {
                      foreach ($data['productosTen'] as $producto) {
                  ?>
                  <tr>
                    <td><?= $producto['idproducto'] ?></td>
                    <td><?= $producto['nombre'] ?></td>
                    <td><?= SMONEY.formatMoney($producto['precio']) ?></td>
                    <td><a href="<?= base_url() ?>/tienda/producto/<?= $producto['idproducto'].'/'.$producto['ruta'] ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                  </tr>
                  <?php } } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="container-title">
              <h3 class="tile-title">Ventas por mes</h3>
              <div class="dflex">
                <input class="date-picker ventasMes" name="ventasMes" placeholder="Mes y Año" onkeydown="return false">
                <button type="button" class="btnVentasMes btn btn-info btn-sm" onclick="fntSearchMes()"> <i class="fas fa-search"></i> </button>
              </div>
            </div>
            <div id="graficaMes"></div>
          </div>
        </div>
      </div>
    </main>
    <?php footer_Admin($data); ?>

    <!-- Graps -->
    <script>
      // Grafico Lineal
      Highcharts.chart('graficaMes', {
          chart: {
              type: 'line'
          },
          title: {
              text: 'Ventas de <?= $data['ventasDia']['mes'].' del '.$data['ventasDia']['anio']; ?>'
          },
          subtitle: {
              text: 'Total Ventas <?= SMONEY.formatMoney($data['ventasDia']['total']); ?>'
          },
          xAxis: {
              categories: [
                <?php
                  foreach ($data['ventasDia']['ventas'] as $dia) {
                    echo $dia['dia'].",";
                  }
                ?>
              ]
          },
          yAxis: {
              title: {
                  text: 'Temperature (°C)'
              }
          },
          plotOptions: {
              line: {
                  dataLabels: {
                      enabled: true
                  },
                  enableMouseTracking: false
              }
          },
          series: [{
              name: 'Tokyo',
              data: [
                <?php
                  foreach ($data['ventasDia']['ventas'] as $dia) {
                    echo $dia['total'].",";
                  }
                ?>
              ]
          }]
      });
    </script>