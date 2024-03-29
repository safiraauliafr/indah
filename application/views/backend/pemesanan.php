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
                        <a class="active" href="<?= base_url('admin/tagihan', '') ?>">
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
                        <h2 class="text-center">Data Pemesanan</h2>

                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id Invoice</th>
                                    <th>Tanggal</th>
                                    <th>Tenggat</th>
                                    <th>Alamat</th>
                                    <th>Kode Pos</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                foreach ($invoice as $invoice_item) : ?>

                                <?php if ($invoice_item->status == 'confirmed') : ?>
                                <tr>
                                    <td><?php echo $no++ . "." ?></td>
                                    <td><?= $invoice_item->id_invoice ?></td>
                                    <td><?= $invoice_item->tanggal ?></td>
                                    <td><?= $invoice_item->tenggat ?></td>
                                    <td><?= $invoice_item->alamat ?></td>
                                    <td><?= $invoice_item->kode_pos ?></td>
                                    <td><button class='btn btn-warning'
                                            onclick='lihat_pemesanan($invoice_item->id_invoice)'><i
                                                class='glyphicon glyphicon-pencil'></i></button></td>
                                </tr>
                                <?php endif ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

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
<script type="text/javascript">
$(document).ready(function() {
    $('#table_id').DataTable();
});
var save_method; //for save method string
var table;


function tambah_pekerjaan() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('#modal_form').modal('show');
    $('.modal-title').text('Tambah pekerjaan'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
}

function edit_pekerjaan(id) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals

    //Ajax Load data from ajax
    $.ajax({
        url: "<?php echo base_url('operator/pekerjaan/edit_pekerjaan') ?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {

            $('[name="pekerjaan_id"]').val(data.pekerjaan_id);
            $('[name="deskripsi"]').val(data.deskripsi);
            $('[name="nama_aset"]').val(data.nama_asset);
            $('[name="nama_pekerja"]').val(data.nama_pekerja);
            $('[name="nama_brand"]').val(data.nama_brand);
            $('[name="nama_department"]').val(data.nama_department);
            $('[name="nama_lokasi"]').val(data.nama_lokasi);
            $('[name="tanggal_mulai"]').val(data.tanggal_mulai);
            $('[name="tanggal_selesai"]').val(data.tanggal_selesai);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit pekerjaan'); // Set title to Bootstrap modal title

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}



function save() {
    var url;
    if (save_method == 'add') {
        url = "<?php echo site_url('operator/pekerjaan/tambah_pekerjaan') ?>";
    } else {
        url = "<?php echo site_url('operator/pekerjaan/update_pekerjaan') ?>";
    }

    // ajax adding data to database
    $.ajax({
        url: url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data) {
            //if success close modal and reload ajax table
            $('#modal_form').modal('hide');
            location.reload(); // for reload a page
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Tunggu sebentar sistem sedang mengirim email');
            $('#modal_form').modal('hide');
            location.reload();
        }
    });
}

function delete_pekerjaan(id) {
    if (confirm('Apakah kamu yakin mau menghapus data ini?')) {
        // ajax delete data from database
        $.ajax({
            url: "<?php echo site_url('operator/pekerjaan/hapus_pekerjaan') ?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {

                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error deleting data');
            }
        });

    }
}
</script>


<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-left">Pemesanan</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="pekerjaan_id" />
                    <div class="form-group">
                        <label class="control-label col-md-3">Id Invoice</label>
                        <div class="col-md-9">
                            <input type="text" name="id_invoice" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Tanggal</label>
                        <div class="col-md-9">
                            <input type="text" name="tanggal" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Tenggat</label>
                        <div class="col-md-9">
                            <input type="text" name="tenggat" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Alamat</label>
                        <div class="col-md-9">
                            <input type="text" name="alamat" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Kode Pos</label>
                        <div class="col-md-9">
                            <input type="text" name="id_invoice" readonly>
                        </div>
                    </div>

                </form>


                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

</html>