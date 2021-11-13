<!DOCTYPE html>
<html lang="es">
  <head>
    <title><?= $data['page_tag']; ?></title>
    <meta charset="utf-8">
    <meta name="description" content="Tienda Virtual.">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="author" content="Jean Cuadros">
    <meta name="theme-color" content="#009688">

    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Tienda Virtual.">

    <!-- Icos -->
    <link rel="shortcut icon" type="text/css" href="<?= media(); ?>/img/favicon.ico">

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/bootstrap-select.min.css">
    <!-- <link type="text/css" rel="stylesheet" href="<?= media(); ?>/css/bootstrap-datetimepicker.min.css"/> -->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">
    <!-- Font-icon css-->
    <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  </head>
  <body class="app sidebar-mini">

    <div id="divLoading">
      <div>
        <img src="<?= media(); ?>/img/icon/loading.svg" alt="Loading">
      </div>
    </div>

    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="<?= base_url();?>/dashboard">Alquiler</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!-- <li class="app-search d-none d-md-block">
          <input class="app-search__input" type="search" placeholder="Buscar">
          <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li> -->

        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <!-- <li><a class="dropdown-item" href="<?= base_url();?>/opciones"><i class="fa fa-cog fa-lg"></i> Settings</a></li> -->
            <li><a class="dropdown-item" href="<?= base_url();?>/usuarios/perfil"><i class="fa fa-user fa-lg"></i> Perfil</a></li>
            <li><a class="dropdown-item" href="<?= base_url();?>/logout"><i class="fa fa-sign-out fa-lg"></i> Salir</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <?php require_once("nav_admin.php"); ?>

    <?php
      $menu = "";
      if (isset($data['menu'])) {$menu = $data['menu'];}

      if (!empty($_SESSION['permisos'][MUSUARIOS]['u'])) {
        switch($menu){
          case "dashboard":
            echo '<script>document.querySelector(".app-menu li:nth-child(1n) a").classList.add("active")</script>';
            break;
          case "roles":
            echo '<script>document.querySelector(".app-menu li:nth-child(2n) a").classList.add("active")</script>';
            break;
          case "usuarios":
            echo '<script>document.querySelector(".app-menu li:nth-child(3n) a").classList.add("active")</script>';
            break;
          case "categorias":
            echo '<script>document.querySelector(".app-menu li:nth-child(4n) a").classList.add("active")</script>';
            break;
          case "productos":
            echo '<script>document.querySelector(".app-menu li:nth-child(5n) a").classList.add("active")</script>';
            break;
          case "contactos":
            echo '<script>document.querySelector(".app-menu li:nth-child(6n) a").classList.add("active")</script>';
            break;
          case "pedidos":
            echo '<script>document.querySelector(".app-menu li:nth-child(7n) a").classList.add("active")</script>';
            break;
          case "gastos":
            echo '<script>document.querySelector(".app-menu li:nth-child(8n) a").classList.add("active")</script>';
            break;
          case "caja":
            echo '<script>document.querySelector(".app-menu li:nth-child(9n) a").classList.add("active")</script>';
            break;
          default:
            echo '<script>document.querySelector(".app-menu li:nth-child(3n) a").classList.add("active")</script>';
            break;
        }
      }else{
        switch($menu){
          case "dashboard":
            echo '<script>document.querySelector(".app-menu li:nth-child(1n) a").classList.add("active")</script>';
            break;
          case "usuarios":
            echo '<script>document.querySelector(".app-menu li:nth-child(2n) a").classList.add("active")</script>';
            break;
          case "categorias":
            echo '<script>document.querySelector(".app-menu li:nth-child(3n) a").classList.add("active")</script>';
            break;
          case "productos":
            echo '<script>document.querySelector(".app-menu li:nth-child(4n) a").classList.add("active")</script>';
            break;
          case "contactos":
            echo '<script>document.querySelector(".app-menu li:nth-child(5n) a").classList.add("active")</script>';
            break;
          case "pedidos":
            echo '<script>document.querySelector(".app-menu li:nth-child(6n) a").classList.add("active")</script>';
            break;
          case "gastos":
            echo '<script>document.querySelector(".app-menu li:nth-child(7n) a").classList.add("active")</script>';
            break;
          case "caja":
            echo '<script>document.querySelector(".app-menu li:nth-child(8n) a").classList.add("active")</script>';
            break;
          default:
            echo '<script>document.querySelector(".app-menu li:nth-child(2n) a").classList.add("active")</script>';
            break;
        }
      }
    ?>