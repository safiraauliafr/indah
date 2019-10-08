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
                        <a class="active" href="<?= base_url('admin/dashboard', '') ?>">
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
                <div class="row mt">
                    <div class="col-lg-6 col-md-6 col-sm-12">

                        <h2>Data Transaksi</h2>
                        <hr>
                        <form method="get" action="">
                            <label>Filter Berdasarkan</label><br>
                            <select name="filter" id="filter">
                                <option value="">Pilih</option>
                                <!-- <option value="1">Per Tanggal</option> -->
                                <option value="2">Per Bulan</option>
                            </select>
                            <br /><br />

                            <div id="form-bulan">
                                <label>Bulan</label><br>
                                <select name="bulan">
                                    <option value="">Pilih</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                <br /><br />
                            </div>
                            <div id="form-tahun">
                                <label>Tahun</label><br>
                                <select name="tahun">
                                    <option value="">Pilih</option>
                                    <?php
                                    foreach ($option_tahun as $data) { // Ambil data tahun dari model yang dikirim dari controller
                                        echo '<option value="' . $data->tahun . '">' . $data->tahun . '</option>';
                                    }
                                    ?>
                                </select>
                                <br /><br />
                            </div>
                            <button type="submit">Tampilkan</button>
                            <a href="<?php echo base_url() . "admin/laporan_transaksi/index/" ?>">Reset Filter</a>
                        </form>
                        <hr />

                        <!-- <b><?php echo $ket; ?></b><br /><br /> -->
                        <a href="<?php echo $url_cetak; ?>">CETAK PDF</a><br /><br />
                        <table border="1" cellpadding="8">
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Biaya</th>
                            </tr>
                            <?php
                            if (!empty($transaksi)) {
                                $no = 1;
                                foreach ($transaksi as $data) {
                                    $tgl = date('d-m-Y', strtotime($data->tgl));

                                    echo "<tr>";
                                    echo "<td>" . $tgl . "</td>";
                                    echo "<td>" . $data->nama_barang . "</td>";
                                    echo "<td>" . $data->jumlah . "</td>";
                                    echo "<td>" . $data->harga . "</td>";
                                    echo "</tr>";
                                    $no++;
                                }
                            }
                            ?>

                            <script src="<?php echo base_url('assets/jquery-ui/jquery-ui.min.js'); ?>"></script>
                            <!-- Load file plugin js jquery-ui -->
                            <script>
                            $(document).ready(function() { // Ketika halaman selesai di load
                                $('.input-tanggal').datepicker({
                                    dateFormat: 'yy-mm-dd' // Set format tanggalnya jadi yyyy-mm-dd
                                });
                                $('#form-tanggal, #form-bulan, #form-tahun')
                                    .hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya
                                $('#filter').change(function() { // Ketika user memilih filter
                                    if ($(this).val() == '1') { // Jika filter nya 1 (per tanggal)
                                        $('#form-bulan, #form-tahun')
                                            .hide(); // Sembunyikan form bulan dan tahun
                                        $('#form-tanggal').show(); // Tampilkan form tanggal
                                    } else if ($(this).val() == '2') { // Jika filter nya 2 (per bulan)
                                        $('#form-tanggal').hide(); // Sembunyikan form tanggal
                                        $('#form-bulan, #form-tahun')
                                            .show(); // Tampilkan form bulan dan tahun
                                    } else { // Jika filternya 3 (per tahun)
                                        $('#form-tanggal, #form-bulan')
                                            .hide(); // Sembunyikan form tanggal dan bulan
                                        $('#form-tahun').show(); // Tampilkan form tahun
                                    }
                                    $('#form-tanggal input, #form-bulan select, #form-tahun select')
                                        .val(
                                            ''
                                        ); // Clear data pada textbox tanggal, combobox bulan & tahun
                                })
                            })
                            </script>
                    </div>
                </div>
                </ <!-- /row -->
            </section>
        </section>
        <!--main content end-->
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

</body>

</html>