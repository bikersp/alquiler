    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= media();?>/img/icon/avatar.png" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?= $_SESSION['userData']['nombres']; ?></p>
          <p class="app-sidebar__user-designation"><?= $_SESSION['userData']['nombrerol']; ?></p>
        </div>
      </div>
      <ul class="app-menu">
        <?php if (!empty($_SESSION['permisos'][MDASHBOARD]['r'])) {?>
        <li>
          <a class="app-menu__item" href="<?= base_url();?>/dashboard">
            <i class="app-menu__icon fa fa-dashboard"></i>
            <span class="app-menu__label">Dashboard</span>
          </a>
        </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][MUSUARIOS]['u'])) {?>
        <li>
          <a class="app-menu__item" href="<?= base_url();?>/roles">
            <i class="app-menu__icon fa fa-user"></i>
            <span class="app-menu__label">Roles</span>
          </a>
        </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][MUSUARIOS]['r'])) {?>
        <li>
          <a class="app-menu__item" href="<?= base_url();?>/usuarios">
            <i class="app-menu__icon fa fa-users"></i>
            <span class="app-menu__label">Usuarios</span>
          </a>
        </li>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][MCATEGORIAS]['r'])) {?>
        <li>
          <a class="app-menu__item" href="<?= base_url();?>/categorias">
            <i class="app-menu__icon fas fa-home"></i>
            <span class="app-menu__label">Cuartos</span>
          </a>
        </li>
        <?php } ?>
        <?php if(!empty($_SESSION['permisos'][MPRODUCTOS]['r'])){ ?>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/productos">
                <i class="app-menu__icon fas fa-house-user" aria-hidden="true"></i>
                <span class="app-menu__label">Inquilinos</span>
            </a>
        </li>
         <?php } ?>
        <?php if(!empty($_SESSION['permisos'][MCONTACTOS]['r'])){ ?>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/contactos">
                <i class="app-menu__icon fas fa-envelope" aria-hidden="true"></i>
                <span class="app-menu__label">Mensajes</span>
            </a>
        </li>
         <?php } ?>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/pedidos">
                <i class="app-menu__icon fas fa-hand-holding-usd" aria-hidden="true"></i>
                <span class="app-menu__label">Pagos</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/gastos">
                <i class="app-menu__icon fas fa-dollar-sign" aria-hidden="true"></i>
                <span class="app-menu__label">Gastos</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/caja">
                <i class="app-menu__icon fas fa-piggy-bank" aria-hidden="true"></i>
                <span class="app-menu__label">Caja</span>
            </a>
        </li>
        <li>
          <a class="app-menu__item" href="<?= base_url();?>/logout">
            <i class="app-menu__icon fa fa-sign-out"></i>
            <span class="app-menu__label">Salir</span>
          </a>
        </li>
      </ul>
    </aside>