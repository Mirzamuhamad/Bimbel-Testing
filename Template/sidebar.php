<?php $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); ?>
<?php $Link = $uriSegments[3]; ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="../view/dashboard" class="brand-link">
    <?php
    if ($Logo['LogoCompany'] == null || $Logo['LogoCompany'] == "") {
    ?>
      <img src="../Logo/logodp.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-2" style="opacity: .8">
    <?php } else { ?>
      <img src="../Logo/<?= $Logo['LogoCompany'] ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-2" style="opacity: .8">
    <?php } ?>
    <span class="brand-text font-weight-light">Welltraine</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <!-- <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data </p>
                </a>
              </li>
            </ul>
          </li> -->
        <li class="nav-item">
          <a href="../View/dashboard" class="nav-link ">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>

        <?php if ($Link == 'tr_Order') {  ?>
          <li class="nav-item has-treeview menu-open">
          <?php } else { ?>
          <li class="nav-item">
          <?php } ?>
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Data Order
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="../View/tr_Order" <?php if ($Link == 'tr_Order') {  ?> class="nav-link Active" <?php } else { ?>class="nav-link" <?php } ?>>
                <i class="fas fa-fw fa-chevron-right"></i>
                <p>Data Order Murid</p>
              </a>
            </li>

          </ul>
          </li>

          <?php if ($Link == 'ms_course' or $Link == 'ms_kurikulum' or $Link == 'ms_olimpiade' or $Link == 'ms_venue' or $Link == 'ms_organizer') {  ?>
            <li class="nav-item has-treeview menu-open">
            <?php } else { ?>
            <li class="nav-item">
            <?php } ?>
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Master Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../View/ms_course" <?php if ($Link == 'ms_course') {  ?> class="nav-link Active" <?php } else { ?>class="nav-link" <?php } ?>>
                  <i class="fas fa-fw fa-chevron-right"></i>
                  <p>Master Course</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="../View/ms_kurikulum" <?php if ($Link == 'ms_kurikulum') {  ?> class="nav-link Active" <?php } else { ?>class="nav-link" <?php } ?>>
                  <i class="fas fa-fw fa-chevron-right"></i>
                  <p>Master Kurikulum</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="../View/ms_venue" <?php if ($Link == 'ms_venue') {  ?> class="nav-link Active" <?php } else { ?>class="nav-link" <?php } ?>>
                  <i class="fas fa-fw fa-chevron-right"></i>
                  <p>Master Venue</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="../View/ms_organizer" <?php if ($Link == 'ms_organizer') {  ?> class="nav-link Active" <?php } else { ?>class="nav-link" <?php } ?>>
                  <i class="fas fa-fw fa-chevron-right"></i>
                  <p>Master Organizer</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="../View/ms_olimpiade" <?php if ($Link == 'ms_olimpiade') {  ?> class="nav-link Active" <?php } else { ?>class="nav-link" <?php } ?>>
                  <i class="fas fa-fw fa-chevron-right"></i>
                  <p>Master Olimpiade</p>
                </a>
              </li>

            </ul>

            </li>
            <?php if ($Link == 'ms_kwalifikasi' or $Link == 'ms_guru') {  ?>
              <li class="nav-item has-treeview menu-open">
              <?php } else { ?>
              <li class="nav-item">
              <?php } ?>
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Data Guru
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../View/ms_guru" <?php if ($Link == 'ms_guru') {  ?> class="nav-link Active" <?php } else { ?>class="nav-link" <?php } ?>>
                    <i class="fas fa-fw fa-chevron-right"></i>
                    <p>Master Guru</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../View/ms_kwalifikasi" <?php if ($Link == 'ms_kwalifikasi') {  ?> class="nav-link Active" <?php } else { ?>class="nav-link" <?php } ?>>
                    <i class="fas fa-fw fa-chevron-right"></i>
                    <p>Master Kwalifikasi</p>
                  </a>
                </li>

              </ul>
              </li>
              <li class="nav-header">SETTING</li>
              <li class="nav-item">
                <a href="#" class="nav-link" data-toggle="modal" data-target="#logout">
                  <i class="nav-icon fas fa-fw fa-sign-out-alt"></i>
                  <p>
                    Logout
                  </p>
                </a>
              </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>