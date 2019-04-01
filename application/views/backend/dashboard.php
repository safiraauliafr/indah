<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Admin Butik Indah Busana Muslim</title>

  <!-- Favicons -->
  <link href="<?=base_url('assets/backend/img/favicon.png', '')?>" rel="icon">
  <link href="<?=base_url('assets/backend/img/apple-touch-icon.png', '')?>" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="<?=base_url('assets/backend/lib/bootstrap/css/bootstrap.min.css', '')?>" rel="stylesheet">
  <!--external css-->
  <link href="<?=base_url('assets/backend/lib/font-awesome/css/font-awesome.css', '')?>" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/css/zabuto_calendar.css', '')?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/lib/gritter/css/jquery.gritter.css', '')?>" />
  <!-- Custom styles for this template -->
  <link href="<?=base_url('assets/backend/css/style.css', '')?>" rel="stylesheet">
  <link href="<?=base_url('assets/backend/css/style.css', '')?>" rel="stylesheet">
  <script src="<?=base_url('assets/backend/lib/chart-master/Chart.js', '')?>"></script>

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <?php foreach ($company as $company1): ?>
      <a href="<?=base_url('admin/dashboard', '')?>" class="logo"><?php echo $company1->nama ?></a>
      <?php endforeach ?>
      <!--logo end-->
         <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="<?=base_url('admin/akun/keluar', '')?>">Logout</a></li>
        </ul>
      </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <?php foreach ($user as $user1): ?>
            <?php if ($user1->avatar == ""): ?>
              <p class="centered"><img class="img-circle" src="<?=base_url('assets/backend/img/avatar.png', '')?>" style="width: 60px; height: 60px"></p>
            <?php elseif ($user1->avatar != ""): ?>
              <p class="centered"><img class="img-circle" src="<?=base_url('assets/uploads/', '')?><?php echo $user1->avatar ;?>" style="width: 60px; height: 60px"></p>
            <?php endif ?>
          <h5 class="centered"><?php echo $user1->nama_depan . " " . $user1->nama_belakang ?></h5>
        <?php endforeach ?>
      <li class="mt">
            <a class="active" href="<?=base_url('admin/dashboard', '')?>">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
              </a>
          </li>
           <li>
            <a  href="<?=base_url('admin/akun', '')?>">
              <i class="fa fa-user"></i>
              <span>Edit Profil</span>
              </a>
          </li>
           <li>
            <a  href="<?=base_url('admin/user', '')?>">
              <i class="fa fa-users"></i>
              <span>Data User</span>
              </a>
          </li>
            </li>
           
          <li>
            <a href="<?=base_url('admin/produk', '')?>">
              <i class="fa fa-shopping-cart"></i>
              <span>Data Produk</span>
              </a>
          </li>

            <li>
            <a href="<?=base_url('admin/company_profile', '')?>">
              <i class="fa fa-address-card"></i>
              <span>Data Perusahaan</span>
              </a>
          </li>
           <li>
            <a href="<?=base_url('admin/tagihan', '')?>">
              <i class="fa fa-handshake-o"></i>
              <span>Validasi Pembayaran</span>
              </a>
          </li>
           <li>
            <a href="<?=base_url('admin/c_produk', '')?>">
              <i class="fa fa-file-text-o fa-fw"></i>
              <span>Laporan Data Produk</span>
              </a>
          </li>
           <li>
            <a href="<?=base_url('admin/laptrans/cetak', '')?>">
              <i class="fa fa-file-text-o fa-fw"></i>
              <span>Laporan Transaksi Keuangan</span>
              </a>
          </li>  
           <li>
            <a href="<?=base_url('admin/laporan_transaksi', '')?>">
              <i class="fa fa-file-text-o fa-fw"></i>
              <span>Laporan</span>
              </a>
          </li>
        

        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <h2 class="text-center">Selamat Datang di Halaman Admin</h2>
        </div>
        <!-- /row -->
      </section>
    </section>
    <!--main content end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="<?=base_url('assets/backend/lib/jquery/jquery.min.js', '')?>"></script>

  <script src="<?=base_url('assets/backend/lib/bootstrap/js/bootstrap.min.js', '')?>"></script>
  <script class="include" type="text/javascript" src="<?=base_url('assets/backend/lib/jquery.dcjqaccordion.2.7.js', '')?>"></script>
  <script src="<?=base_url('assets/backend/lib/jquery.scrollTo.min.js', '')?>"></script>
  <script src="<?=base_url('assets/backend/lib/jquery.nicescroll.js', '')?>" type="text/javascript"></script>
  <script src="<?=base_url('assets/backend/lib/jquery.sparkline.js', '')?>"></script>
  <!--common script for all pages-->
  <script src="<?=base_url('assets/backend/lib/common-scripts.js', '')?>"></script>
  <script type="text/javascript" src="<?=base_url('assets/backend/lib/gritter/js/jquery.gritter.js', '')?>"></script>
  <script type="text/javascript" src="<?=base_url('assets/backend/lib/gritter-conf.js', '')?>"></script>
  <!--script for this page-->
  <script src="<?=base_url('assets/backend/lib/sparkline-chart.js', '')?>"></script>
  <script src="<?=base_url('assets/backend/lib/zabuto_calendar.js', '')?>"></script>
  
</body>

</html>
