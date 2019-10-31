<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>Produk</title>

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
                        <a href="<?= base_url('admin/user', '') ?>">
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
                        <a class="active" href="<?= base_url('admin/produk', '') ?>">
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
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center">Daftar Produk</h1>
                        <h1>Tambah Produk Baru</h1>
                        <?php
            echo validation_errors('<div class="alert alert-danger">', '</div>');
            @print($error);
            echo form_open_multipart('admin/produk/tambah', ['class' => 'form-horizontal'])
            ?>
                        <div class="form-group">
                            <label for="namaProduk" class="col-sm-2 control-label">Nama produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="namaProduk" name="nama"
                                    value="<?= set_value('nama') ?>" placeholder="Nama" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hargaProduk" class="col-sm-2 control-label">Harga satuan produk</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-addon"><abbr title="Rupiah">Rp</abbr></div>
                                    <input type="number" min="0" class="form-control" id="hargaProduk" name="harga"
                                        value="<?= set_value('harga') ?>" placeholder="Harga" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="persediaanProduk" class="col-sm-2 control-label">Jumlah persediaan produk
                                (stock)</label>
                            <div class="col-sm-10">
                                <input type="number" min="0" class="form-control" id="persediaanProduk"
                                    name="persediaan" value="<?= set_value('persediaan') ?>" placeholder="Persediaan"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="beratProduk" class="col-sm-2 control-label">Dimensi produk</label>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <input type="number" min="0" step="0.1" class="form-control" id="beratProduk"
                                        name="berat" value="<?= set_value('berat') ?>" placeholder="Berat" required>
                                    <div class="input-group-addon"><abbr title="kilogram">kg</abbr></div>
                                </div>
                            </div>
                            <label for="panjangProduk" class="col-sm-2 control-label">Panjang / Lebar / Tinggi</label>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <input type="number" min="0" step="0.1" class="form-control" id="panjangProduk"
                                        name="panjang" value="<?= set_value('panjang') ?>" placeholder="Panjang">
                                    <div class="input-group-addon"><abbr title="sentimeter">cm</abbr></div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <input type="number" min="0" step="0.1" class="form-control" id="lebarProduk"
                                        name="lebar" value="<?= set_value('lebar') ?>" placeholder="Lebar">
                                    <div class="input-group-addon"><abbr title="sentimeter">cm</abbr></div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <input type="number" min="0" step="0.1" class="form-control" id="tinggiProduk"
                                        name="tinggi" value="<?= set_value('tinggi') ?>" placeholder="Tinggi">
                                    <div class="input-group-addon"><abbr title="sentimeter">cm</abbr></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="deskripsiProduk" class="col-sm-2 control-label">Deskripsi produk</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="deskripsiProduk" name="deskripsi"
                                    placeholder="Deskripsi" maxlength="255"><?= set_value('deskripsi') ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gambarProduk" class="col-sm-2 control-label">Gambar produk</label>
                            <div class="col-sm-10">
                                <input type="file" id="gambarProduk" name="gambar" accept="image/jpeg, image/png"
                                    required>
                                <p class="help-block">Unggah satu foto dari produk yang akan dijual (format: .jpg,
                                    .jpeg, .png)</p>
                            </div>
                        </div>
                        <div class="col-sm-10 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary">Tambahkan</button>
                            <button type="reset" class="btn btn-default">Atur ulang kembali form</button>
                        </div>
                        <?= form_close() ?>
                        <br>

                    </div>
                </div>
                <!-- /row -->
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