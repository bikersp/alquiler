<!DOCTYPE html>
<html lang="es">
  <head>
    <title><?= $data['page_tag']; ?></title>
    <meta charset="utf-8">
    <meta name="description" content="Tienda Virtual.">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Jean Cuadros">
    <meta name="theme-color" content="#009688">

    <link rel="shortcut icon" type="text/css" href="<?= media(); ?>/img/favicon.ico">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1><?= $data['page_title']; ?></h1>
      </div>
      <div class="login-box">

        <div id="divLoading">
          <div>
            <img src="<?= media(); ?>/img/icon/loading.svg" alt="Loading">
          </div>
        </div>

        <form class="login-form" id="formLogin" name="formLogin" action="">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>INICIAR SESIÓN</h3>
          <div class="form-group">
            <label class="control-label">USUARIO</label>
            <input id="txtEmail" name="txtEmail" class="form-control" type="text" placeholder="Teléfono o Email" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">CONTRASEÑA</label>
            <input id="txtPassword" name="txtPassword" class="form-control" type="password" placeholder="Contraseña">
          </div>
          <div class="form-group">
            <div class="utility">
              <!-- <div class="animated-checkbox">
                <label>
                  <input type="checkbox"><span class="label-text">Mantener conectado</span>
                </label>
              </div> -->
              <p class="semibold-text mb-2"><a href="#" data-toggle="flip">¿Olvidaste tu contraseña?</a></p>
            </div>
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> INICIAR SESIÓN</button>
          </div>
        </form>

        <form class="forget-form" id="formRessetPass" name="formRessetPass" action="">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>¿Olvidaste tu contraseña?</h3>
          <div class="form-group">
            <label class="control-label">EMAIL</label>
            <input id="txtEmailResset" name="txtEmailResset" class="form-control" type="email" placeholder="Email">
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i> REINICIAR CONTRASEÑA</button>
          </div>
          <div class="form-group mt-2">
            <p class="semibold-text"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Iniciar Sesión</a></p>
          </div>
        </form>
      </div>
    </section>
    <script> const base_url = "<?= base_url(); ?>";</script>
    <!-- Essential javascripts for application to work-->
    <script type="text/javascript" src="<?= media(); ?>/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/popper.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/fontawesome.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/pace.min.js"></script>
    <!-- Sweet Alert plugin-->
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/sweetalert.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="<?= media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>
  </body>
</html>