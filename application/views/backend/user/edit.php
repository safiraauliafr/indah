<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>Pelanggan</title>

    <!-- Favicons -->
    <link href="<?= base_url('assets/backend/img/favicon.png', '') ?>" rel="icon">
    <link href="<?= base_url('assets/backend/img/apple-touch-icon.png', '') ?>" rel="apple-touch-icon">

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('assets/backend/lib/bootstrap/css/bootstrap.min.css', '') ?>" rel="stylesheet">
    <!--external css-->
    <link href="<?= base_url('assets/backend/lib/font-awesome/css/font-awesome.css', '') ?>" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/backend/css/zabuto_calendar.css', '') ?>">
    <link rel="stylesheet" type="text/css"
        href="<?= base_url('assets/backend/lib/gritter/css/jquery.gritter.css', '') ?>" />
    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/backend/css/style.css', '') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/backend/css/style.css', '') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/backend/lib/chart-master/Chart.js', '') ?>"></script>

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
            <?php foreach ($company as $company1) : ?>
            <a href="<?= base_url('admin/dashboard', '') ?>" class="logo"><?php echo $company1->nama ?></a>
            <?php endforeach ?>
            <!--logo end-->
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="<?= base_url('admin/akun/keluar', '') ?>">Logout</a></li>
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
                    <?php foreach ($user as $user1) : ?>
                    <?php if ($user1->avatar == "") : ?>
                    <p class="centered"><img class="img-circle"
                            src="<?= base_url('assets/backend/img/avatar.png', '') ?>"
                            style="width: 60px; height: 60px"></p>
                    <?php elseif ($user1->avatar != "") : ?>
                    <p class="centered"><img class="img-circle"
                            src="<?= base_url('assets/uploads/', '') ?><?php echo $user1->avatar; ?>"
                            style="width: 60px; height: 60px"></p>
                    <?php endif ?>
                    <h5 class="centered"><?php echo $user1->nama_depan . " " . $user1->nama_belakang ?></h5>
                    <?php endforeach ?>
                    <li class="mt">
                        <a href="<?= base_url('admin/dashboard', '') ?>">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/akun', '') ?>">
                            <i class="fa fa-user"></i>
                            <span>Edit Profil</span>
                        </a>
                    </li>
                    <li>
                        <a class="active" href="<?= base_url('admin/user', '') ?>">
                            <i class="fa fa-users"></i>
                            <span>Data User</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/account', '') ?>">
                            <i class="fa fa-cog"></i>
                            <span> User</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/produk', '') ?>">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Data Produk</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= base_url('admin/company_profile', '') ?>">
                            <i class="fa fa-address-card"></i>
                            <span>Data Perusahaan</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/tagihan', '') ?>">
                            <i class="fa fa-handshake-o"></i>
                            <span>Validasi Pembayaran</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/laporan_produk', '') ?>">
                            <i class="fa fa-file-text-o fa-fw"></i>
                            <span>Laporan Data Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/laporan_transaksi', '') ?>">
                            <i class="fa fa-file-text-o fa-fw"></i>
                            <span>Laporan Transaksi Keuangan</span>
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

                <div class="container">
                    <h1>Pengaturan Akun</h1>
                    <?php
                    echo validation_errors('<div class="alert alert-danger">', '</div>');
                    @print($this->session->flashdata('error'));
                    ?>
                    <div class="row">
                        <div class="col-sm-12 ">
                            <div id="edit" class="tab-pane">
                                <div class="row">
                                    <div class="col-lg-8 col-lg-offset-2 detailed">
                                        <form role="form" class="form-horizontal"
                                            action="<?php echo base_url('admin/user/edited'); ?>"
                                            class="form-horizontal" method="post">
                                            <?php foreach ($user as $user1) : ?>
                                            <input type="hidden" name="id_pengguna"
                                                value="<?= $this->uri->segment('3'); ?>">
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Nama Depan</label>
                                                <div class="col-lg-6">
                                                    <input type="text" placeholder="Masukkan Nama Depan" id="nama_depan"
                                                        name="nama_depan" class="form-control"
                                                        value="<?php echo $user1->nama_depan; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Nama Belakang</label>
                                                <div class="col-lg-6">
                                                    <input type="text" placeholder="Masukkan Nama Belakang"
                                                        id="nama_belakang" name="nama_belakang" class="form-control"
                                                        value="<?php echo $user1->nama_belakang; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Tanggal Lahir</label>
                                                <div class="col-lg-6">
                                                    <input type="date" placeholder="Masukkan Tanggal Lahir"
                                                        id="tanggal_lahir" name="tanggal_lahir" class="form-control"
                                                        value="<?php echo $user1->tanggal_lahir; ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Grup</label>
                                                <div class="col-lg-6">
                                                    <select class="form-control" name="grup" id="grup" required>
                                                        <option>Grup</option>
                                                        <option value="1"
                                                            <?= (($user1->grup == '1') ? 'selected' : '') ?>>Pelanggan
                                                        </option>
                                                        <option value="2"
                                                            <?= (($user1->grup == '2') ? 'selected' : '') ?>>Admin
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Jenis Kelamin</label>
                                                <div class="col-lg-6">
                                                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin"
                                                        required>
                                                        <option>Jenis Kelamin</option>
                                                        <option value="L"
                                                            <?= (($jenis_kelamin == 'L') ? 'selected' : '') ?>>Laki-laki
                                                        </option>
                                                        <option value="P"
                                                            <?= (($jenis_kelamin == 'P') ? 'selected' : '') ?>>Perempuan
                                                        </option>
                                                    </select>
                                                </div>
                                                <?php endforeach ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Nomor Telepon</label>
                                                <div class="col-lg-6">
                                                    <input type="number" placeholder="Masukkan Nomor Telepon"
                                                        id="nomor_telepon" name="nomor_telepon" class="form-control"
                                                        value="<?php echo $user1->nomor_telepon; ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Provinsi</label>
                                                <div class="col-lg-6">
                                                    <select class="form-control" name="provinsi" id="provinsi" required>
                                                        <option>Provinsi</option>
                                                        <?php foreach ($dd_province as $row) : ?>
                                                        <option value="<?php echo $row->id; ?>"
                                                            <?php if ($row->id == $province_id) : ?> selected="selected"
                                                            <?php endif; ?>>
                                                            <?php echo $row->name; ?>
                                                        </option>
                                                        <?php endforeach; ?>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Kota / Kabupaten</label>
                                                <div class="col-lg-6">
                                                    <select class="form-control" name="kota" id="kota" required>
                                                        <option>Kota / Kabupaten</option>
                                                        <?php foreach ($dd_regency as $row) : ?>
                                                        <option value="<?php echo $row->id; ?>"
                                                            <?php if ($row->id == $regency_id) : ?> selected="selected"
                                                            <?php endif; ?>>
                                                            <?php echo $row->name; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                        <script>
                                                        $(document).ready(function() {
                                                            $("#provinsi").change(function() {
                                                                var url =
                                                                    "<?php echo site_url('admin/akun/get_regencies'); ?>/" +
                                                                    $(this).val();
                                                                $('#kota').load(url);
                                                                return false;
                                                            });
                                                        });
                                                        </script>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Kecamatan</label>
                                                <div class="col-lg-6">
                                                    <select class="form-control" name="kecamatan" id="kecamatan"
                                                        required>
                                                        <option>Kecamatan</option>
                                                        <?php foreach ($dd_district as $row) : ?>
                                                        <option value="<?php echo $row->id; ?>"
                                                            <?php if ($row->id == $district_id) : ?> selected="selected"
                                                            <?php endif; ?>>
                                                            <?php echo $row->name; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                        <script>
                                                        $(document).ready(function() {
                                                            $("#kota").change(function() {
                                                                var url =
                                                                    "<?php echo site_url('admin/akun/get_districts'); ?>/" +
                                                                    $(this).val();
                                                                $('#kecamatan').load(url);
                                                                return false;
                                                            });
                                                        });
                                                        </script>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php foreach ($user as $user1) : ?>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Alamat</label>
                                                <div class="col-lg-10">
                                                    <textarea rows="10" cols="30" class="form-control" id="alamat"
                                                        name="alamat" required><?php echo $user1->alamat; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Kode Pos</label>
                                                <div class="col-lg-6">
                                                    <input type="text" placeholder="Masukkan Kode Pos" id="kode_pos"
                                                        name="kode_pos" class="form-control"
                                                        value="<?php echo $user1->kode_pos; ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button class="btn btn-theme" type="submit">Save</button>
                                                    <a href="<?php echo base_url() . "admin/user/index/" ?>"
                                                        class="btn btn-theme04">Cancel</a> </div>
                                            </div>
                                        </form>
                                        <form role="form" class="form-horizontal"
                                            action="<?php echo base_url('admin/user/update'); ?>" method="post"
                                            class="form-horizontal">
                                            <input type="hidden" name="id" value="<?php echo $user1->id_pengguna; ?>">
                                            <h4 class="mb" style="margin-top: 10px">Informasi Akun</h4>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Email</label>
                                                <div class="col-lg-6">
                                                    <input type="text" placeholder="Masukkan Email anda" id="email"
                                                        name="email" class="form-control"
                                                        value="<?php echo $user1->nama; ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Password</label>
                                                <div class="col-lg-6">
                                                    <input type="password" placeholder="Masukkan Password" id="password"
                                                        name="password" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Password Baru</label>
                                                <div class="col-lg-6">
                                                    <input type="password" placeholder="Masukkan Password Baru"
                                                        id="new_password" name="newpassword" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Konfirmasi Password Baru</label>
                                                <div class="col-lg-6">
                                                    <input type="password"
                                                        placeholder="Masukkan Konfirmasi Password Baru"
                                                        id="confirmpassword" name="confirmpassword" class="form-control"
                                                        f>
                                                </div>
                                            </div>
                                            <?php endforeach ?>
                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button class="btn btn-theme" type="submit">Save</button>
                                                    <a href="<?php echo base_url() . "admin/user/index/" ?>"
                                                        class="btn btn-theme04">Cancel</a> </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /col-lg-8 -->
                                </div>
                                <!-- /row -->
                            </div>
                        </div>
                    </div>
                    <br>
                </div> <!-- /row -->
            </section>
        </section>
        <!--main content end-->
        <!--footer start-->
        <!--<footer class="site-footer">
      <div class="text-center">
        <p>
          &copy; Copyrights <strong>Dashio</strong>. All Rights Reserved
        </p>
        <div class="credits">
                      You are NOT allowed to delete the credit link to TemplateMag with free version.
            You can delete the credit link only if you bought the pro version.
            Buy the pro version with working PHP/AJAX contact form: https://templatemag.com/dashio-bootstrap-admin-template/
            Licensing information: https://templatemag.com/license/
          -->
        <!--Created with Dashio template by <a href="https://templatemag.com/">TemplateMag</a>
        </div>
        <a href="index.html#" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>-->
        <!--footer end-->
    </section>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?= base_url('assets/backend/lib/jquery/jquery.min.js', '') ?>"></script>

    <script src="<?= base_url('assets/backend/lib/bootstrap/js/bootstrap.min.js', '') ?>"></script>
    <script class="include" type="text/javascript"
        src="<?= base_url('assets/backend/lib/jquery.dcjqaccordion.2.7.js', '') ?>"></script>
    <script src="<?= base_url('assets/backend/lib/jquery.scrollTo.min.js', '') ?>"></script>
    <script src="<?= base_url('assets/backend/lib/jquery.nicescroll.js', '') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/backend/lib/jquery.sparkline.js', '') ?>"></script>
    <!--common script for all pages-->
    <script src="<?= base_url('assets/backend/lib/common-scripts.js', '') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/backend/lib/gritter/js/jquery.gritter.js', '') ?>">
    </script>
    <script type="text/javascript" src="<?= base_url('assets/backend/lib/gritter-conf.js', '') ?>"></script>
    <!--script for this page-->
    <script src="<?= base_url('assets/backend/lib/sparkline-chart.js', '') ?>"></script>
    <script src="<?= base_url('assets/backend/lib/zabuto_calendar.js', '') ?>"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Welcome to Dashio!',
            // (string | mandatory) the text inside the notification
            text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo.',
            // (string | optional) the image to display on the left
            image: '<?= base_url("assets/backend/img/avatar.jpg", '
            ') ?>',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: false,
            // (int | optional) the time you want it to be alive for before fading out
            time: 8000,
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
    });
    </script>
    <script type="application/javascript">
    $(document).ready(function() {
        $("#date-popover").popover({
            html: true,
            trigger: "manual"
        });
        $("#date-popover").hide();
        $("#date-popover").click(function(e) {
            $(this).hide();
        });

        $("#my-calendar").zabuto_calendar({
            action: function() {
                return myDateFunction(this.id, false);
            },
            action_nav: function() {
                return myNavFunction(this.id);
            },
            ajax: {
                url: "show_data.php?action=1",
                modal: true
            },
            legend: [{
                    type: "text",
                    label: "Special event",
                    badge: "00"
                },
                {
                    type: "block",
                    label: "Regular event",
                }
            ]
        });
    });

    function myNavFunction(id) {
        $("#date-popover").hide();
        var nav = $("#" + id).data("navigation");
        var to = $("#" + id).data("to");
        console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
    </script>
</body>

</html>