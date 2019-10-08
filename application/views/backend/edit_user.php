<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>KMS Syarfi</title>
    <link rel="shortcut icon" href="<?= base_url('assets/img/icon.png', '') ?>" />

    <!-- Favicons -->
    <link href="<?= base_url('assets/backend/img/favicon.png', '') ?>" rel="icon">
    <link href="<?= base_url('assets/backend/img/apple-touch-icon.png', '') ?>" rel="apple-touch-icon">

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('assets/lib/bootstrap/css/bootstrap.min.css', '') ?>" rel="stylesheet">
    <!--external css-->
    <link href="<?= base_url('assets/lib/font-awesome/css/font-awesome.css', '') ?>" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/zabuto_calendar.css', '') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/lib/gritter/css/jquery.gritter.css', '') ?>" />
    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/css/style.css', '') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css', '') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/lib/chart-master/Chart.js', '') ?>"></script>

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
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <a class="navbar-brand" href="#">KMS - PT. Syarfi Teknologi Finansial</a>
                    <li><a class="logout" href="<?php echo base_url() ?>index.php/admin/dashboard/logout">Logout</a>
                    </li>
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
                    <li class="mt">
                        <a class="active" href="<?= base_url('index.php/admin/dashboard', '') ?>">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('index.php/admin/profil', '') ?>">
                            <i class="fa fa-user"></i>
                            <span>Edit Profil</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('index.php/admin/user', '') ?>">
                            <i class="fa fa-users"></i>
                            <span>Data User</span>
                        </a>
                    </li>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/produk', '') ?>">
                            <i class="fa fa-book"></i>
                            <span>Knowledge</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/produk', '') ?>">
                            <i class="fa fa-paste"></i>
                            <span>Dokumen</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= base_url('index.php/admin/forum', '') ?>">
                            <i class="fa fa-bullhorn"></i>
                            <span>Forum Diskusi</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/tagihan', '') ?>">
                            <i class="fa fa-book"></i>
                            <span>Notulensi</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('index.php/admin/log', '') ?>">
                            <i class="fa fa-inbox"></i>
                            <span>Log Aktivitas</span>
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
                    <div class="col-lg-12 mt">
                        <div id="edit" class="tab-pane">
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2 detailed">
                                    <h4 class="mb">Edit User</h4>
                                    <form role="form" class="form-horizontal"
                                        action="<?php echo base_url('user/updated'); ?>" class="form-horizontal"
                                        method="post" enctype="multipart/form-data">
                                        <?php foreach ($user as $row) : ?>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">ID</label>
                                            <div class="col-lg-6">
                                                <input type="text" placeholder="ID" id="id" name="id"
                                                    class="form-control" value="<?php echo $row['id']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">NIP</label>
                                                <div class="col-lg-6">
                                                    <input type="text" placeholder="NIP" id="nip" name="nip"
                                                        class="form-control" hidden value="<?php echo $row['nip']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Nama Lengkap</label>
                                                <div class="col-lg-6">
                                                    <input type="text" placeholder="Masukkan Nama Lengkap"
                                                        id="nama_user" name="nama_user" class="form-control"
                                                        value="<?php echo $row['nama_user']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Jabatan</label>
                                                <div class="col-lg-6">
                                                    <?php

                                                        if ($row['jabatan'] == "Admin") {

                                                            ?>
                                                    <label class="radio">
                                                        <input type="radio" name="jabatan" id="admin" value="Admin"
                                                            checked>
                                                        Admin
                                                    </label>
                                                    <label class="radio">
                                                        <input type="radio" name="jabatan" id="user" value="User">
                                                        User
                                                    </label>
                                                    <label class="radio">
                                                        <input type="radio" name="jabatan" id="office" value="Office">
                                                        Office
                                                    </label>
                                                    <?php
                                                        } else {
                                                            ?>
                                                    <label class="radio">
                                                        <input type="radio" name="jabatan" id="admin" value="Admin">
                                                        Admin
                                                    </label>
                                                    <label class="radio">
                                                        <input type="radio" name="jabatan" id="user" value="User"
                                                            checked>
                                                        User
                                                    </label>
                                                    <label class="radio">
                                                        <input type="radio" name="jabatan" id="office" value="Office">
                                                        Office
                                                    </label>
                                                    <?php
                                                        }
                                                        ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Tempat Lahir</label>
                                                <div class="col-lg-6">
                                                    <input type="text" placeholder="Masukkan Tempat Lahir"
                                                        id="tempat_lahir" name="tempat_lahir" class="form-control"
                                                        value="<?php echo $row['tempat_lahir']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Tanggal Lahir</label>
                                                <div class="col-lg-6">
                                                    <input type="date" placeholder="Masukkan Tanggal Lahir"
                                                        id="tgl_lahir" name="tgl_lahir" class="form-control"
                                                        value="<?php echo $row['tgl_lahir']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Jenis Kelamin</label>
                                                <div class="col-lg-6">
                                                    <?php

                                                        if ($row['jenis_kelamin'] == "P") {

                                                            ?>
                                                    <label class="radio">
                                                        <input type="radio" name="jenis_kelamin" id="perempuan"
                                                            value="P" checked>
                                                        Perempuan
                                                    </label>
                                                    <label class="radio">
                                                        <input type="radio" name="jenis_kelamin" id="laki" value="L">
                                                        Laki - Laki
                                                    </label>

                                                    <?php
                                                        } else {
                                                            ?>
                                                    <label class="radio">
                                                        <input type="radio" name="jenis_kelamin" id="perempuan"
                                                            value="P">
                                                        Perempuan
                                                    </label>
                                                    <label class="radio">
                                                        <input type="radio" name="jenis_kelamin" id="laki" value="L"
                                                            checked>
                                                        Laki - Laki
                                                    </label>
                                                    <?php
                                                        }
                                                        ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Nomor Handphone</label>
                                                <div class="col-lg-6">
                                                    <input type="number" placeholder="Masukkan Nomor Handphone"
                                                        id="no_hp" name="no_hp" class="form-control"
                                                        value="<?php echo $row['no_hp']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Alamat</label>
                                                <div class="col-lg-10">
                                                    <textarea rows="10" cols="30" class="form-control" id="alamat"
                                                        name="alamat" required><?php echo $row['alamat']; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Username</label>
                                                <div class="col-lg-6">
                                                    <input type="text" placeholder="Masukkan Username" id="username"
                                                        name="username" class="form-control"
                                                        value="<?php echo $row['username']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Email</label>
                                                <div class="col-lg-6">
                                                    <input type="email" placeholder="Masukkan Email" id="email"
                                                        name="email" class="form-control"
                                                        value="<?php echo $row['email']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Password</label>
                                                <div class="col-lg-6">
                                                    <input type="text" placeholder="Masukkan Password" id="password"
                                                        name="password" class="form-control"
                                                        value="<?php echo $row['password']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button class="btn btn-theme" type="submit">Save</button>
                                                    <a href="<?php echo base_url() . "index.php/admin/user/index/" ?>"
                                                        class="btn btn-theme04">Cancel</a> </div>
                                            </div>
                                            <?php endforeach ?>
                                    </form>
                                </div>
                                <!-- /col-lg-8 -->
                            </div>
                            <!-- /row -->
                        </div>

                        <!-- /col-lg-12 -->
                    </div>
                </div>
                <!-- /row -->
            </section>
        </section>
        <!-- js placed at the end of the document so the pages load faster -->
        <script src="<?= base_url('assets/lib/jquery/jquery.min.js', '') ?>"></script>

        <script src="<?= base_url('assets/lib/bootstrap/js/bootstrap.min.js', '') ?>"></script>
        <script class="include" type="text/javascript"
            src="<?= base_url('assets/lib/jquery.dcjqaccordion.2.7.js', '') ?>">
        </script>
        <script src="<?= base_url('assets/lib/jquery.scrollTo.min.js', '') ?>"></script>
        <script src="<?= base_url('assets/lib/jquery.nicescroll.js', '') ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/lib/jquery.sparkline.js', '') ?>"></script>
        <!--common script for all pages-->
        <script src="<?= base_url('assets/lib/common-scripts.js', '') ?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/lib/gritter/js/jquery.gritter.js', '') ?>">
        </script>
        <script type="text/javascript" src="<?= base_url('assets/lib/gritter-conf.js', '') ?>"></script>
        <!--script for this page-->
        <script src="<?= base_url('assets/lib/sparkline-chart.js', '') ?>"></script>
        <script src="<?= base_url('assets/lib/zabuto_calendar.js', '') ?>"></script>

</body>

</html>