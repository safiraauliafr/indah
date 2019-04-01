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
            <a href="<?=base_url('admin/dashboard', '')?>">
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
            <a class="active" href="<?=base_url('admin/tagihan', '')?>">
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
      <h2 class="text-center">Daftar Barang Pesanan pada Tagihan #<?=$tagihan->id_invoice?></h2>
      <table id="<?=$datatable?>" class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th>ID Produk</th>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
            <?php
      $total = 0;
      $totalbarang = 0;
      $totaljenis = 0;
            foreach($pemesanan as $barang) :
                $subtotal = $barang->jumlah * $barang->biaya;
        $total += $subtotal;
        $totalbarang += $barang->jumlah;
        $totaljenis++;
            ?>
        <tr>
          <td><?=$barang->id_pemesanan?></td>
          <td><?=anchor_popup('produk/lihat/' . $barang->id_produk, $barang->nama_produk)?></td>
          <td><?=$barang->jumlah?></td>
          <td><?=number_format($barang->biaya,0,'.',',')?></td>
          <td><?=number_format($subtotal,0,'.',',')?></td>
        </tr>
      <?php endforeach; ?>
        </tbody>
                <tfoot>
          <td class="text-right">Total</td>
          <td><?=$totaljenis?> jenis</td>
          <td><?=$totalbarang?> unit</td>
                    <td colspan="2" class="text-right"><abbr title="Rupiah">Rp</abbr>. <strong><?=number_format($total,0,'.',',')?></strong></td>
                </tfoot>
      </table>
    </div>
  </div>
   <div class="row">
    <?php
    if (isset($pemesan) && !empty($pemesan))
    {
    ?>
    <div class="col-md-6">
      <h3>Detail Pemesanan</h3>
      <dl class="dl-horizontal">
        <dt>Status</dt>
        <dd><?=$tagihan->status?></dd>
        <dt>Waktu pemesanan</dt>
        <dd><?=date('j F Y - H:i:s', strtotime($tagihan->tanggal))?></dd>
        <dt>Tenggat hingga</dt>
        <dd><?=date('j F Y - H:i:s', strtotime($tagihan->tenggat))?></dd>
      </dl>
      <address>
      <h3>Detail Pemesan</h3>
      <strong><?=$pemesan->nama_depan?> <?=$pemesan->nama_belakang?></strong><br>
      <?php
      $alamat = $tagihan->alamat;
      if (empty($alamat))
      {
        $alamat = $pemesan->alamat;
      }
      $alamat = explode(',', $alamat);
      foreach ($alamat as $alamat_item)
      {
        echo $alamat_item, '<br>';
      }
      ?>
      <p><?php
      $kodepos = $tagihan->kode_pos;
      if (empty($kodepos))
      {
        $kodepos = '<i>' . $pemesan->kode_pos.'</i>';
      }
      echo $kodepos;
      ?></p>
      <abbr title="Telepon"><i class="fa fa-phone" aria-hidden="true"></i></abbr> <?=$pemesan->nomor_telepon?><br>
      <abbr title="Surel"><i class="fa fa-envelope" aria-hidden="true"></i></abbr> <a href="mailto:<?=$pemesan->nama?>"><?=$pemesan->nama?></a>
      </address>
    </div>
    <?php
    }
    if (!empty($tagihan->bukti_pembayaran))
    {
    ?>
    <div class="col-md-6">
      <h3>Bukti Transfer</h3>
      <?=img(['src' => PAYMENT_UPLOAD_DIRECTORY .$tagihan->bukti_pembayaran, 'alt' => 'gambar bukti pembayaran', 'width' => 400])?>
    </div>
    <?php
    }
    ?>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="btn-group" role="group" aria-label="Kontrol Pemesanan">
        <?php
        if ($tagihan->status == 'canceled' || $tagihan->status == 'expired')
        {
          if (time() > strtotime($tagihan->tenggat))
          {
            echo anchor('admin/tagihan/hapus/' . $tagihan->id_invoice, '<i class="fa fa-trash" aria-hidden="true"></i> Buang', ['class' => 'btn btn-danger', 'role' => 'button']);
          }
          else
          {
            echo anchor('admin/tagihan/hapus/' . $tagihan->id_invoice, '<i class="fa fa-trash" aria-hidden="true"></i> Buang', ['class' => 'btn btn-danger', 'role' => 'button', 'disabled' => 'disabled', 'title' => 'Hanya dapat dibuang setelah masa tenggat habis']);
          }
        }
        else if ($tagihan->status == 'unpaid')
        {
          echo anchor('admin/tagihan/batal' . $tagihan->id_invoice, '<i class="fa fa-times" aria-hidden="true"></i> Batalkan', ['class' => 'btn btn-danger', 'role' => 'button']);
        }
        else if ($tagihan->status == 'paid')
        {
          echo
            anchor('admin/tagihan/batal/' . $tagihan->id_invoice, '<i class="fa fa-times" aria-hidden="true"></i> Tolak', ['class' => 'btn btn-danger', 'role' => 'button']),
            anchor('admin/tagihan/konfirmasi/' . $tagihan->id_invoice, '<i class="fa fa-check" aria-hidden="true"></i> Terima & Konfirmasi', ['class' => 'btn btn-primary', 'role' => 'button']);
        }
        else if ($tagihan->status == 'confirmed')
        {
            echo anchor('admin/tagihan/konfirmasi/' . $tagihan->id_invoice , '<i class="fa fa-truck" aria-hidden="true"></i> Pengiriman', ['class' => 'btn btn-primary', 'role' => 'button']);
          
        }
        ?>
      </div>
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
  <script type="text/javascript">
    $(document).ready(function() {
      var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'Welcome to Dashio!',
        // (string | mandatory) the text inside the notification
        text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo.',
        // (string | optional) the image to display on the left
        image: '<?=base_url("assets/backend/img/avatar.jpg", '')?>',
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
