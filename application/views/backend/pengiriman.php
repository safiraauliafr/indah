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
            <a href="<?=base_url('admin/laporan_produk', '')?>">
              <i class="fa fa-file-text-o fa-fw"></i>
              <span>Laporan Data Produk</span>
              </a>
          </li>          
           <li>
            <a href="<?=base_url('admin/laporan_transaksi', '')?>">
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
        <?php
            $kurirterpilih = '';
            $jasapengiriman = '';
            $paket_tarif_pengiriman = '';
            $nomorpengiriman = '';

            if (!empty($tagihan->jasa_pengiriman))
            {
                $kurirterpilih = $tagihan->jasa_pengiriman;
            }
            if (!empty($tagihan->paket_tarif_pengiriman))
            {
                $paket_tarif_pengiriman = $tagihan->paket_tarif_pengiriman;
            }
            if (!empty($pengiriman->jasa))
            {
                $jasapengiriman = $pengiriman->jasa;
            }
            else
            {
                $jasapengiriman = $kurirterpilih;
            }
            if (!empty($pengiriman->nomor_resi))
            {
                $nomorpengiriman = $pengiriman->nomor_resi;
            }

            if ($this->input->post('is_submitted'))
            {
              $nomorpengiriman = set_value('nomorpengiriman');
            }
    ?>
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-md-12">
      <h1>Informasi Pengiriman <small>Tagihan #<?=$tagihan->id_invoice?></small></h1>
            <?php
            echo validation_errors('<div class="alert alert-danger">', '</div>');
            $this->view('frontend/flashalert');
            if (isset($pemesan) && !empty($pemesan))
            {
            ?>
            <div class="col-md-5">
                <h3>Dikirim ke:</h3>
                <address>
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
                        $kodepos = '<i>' . $pemesan->kode_pos . '</i>';
                    }
                    echo $kodepos;
                    ?></p>
                    <abbr title="Telepon"><i class="fa fa-phone" aria-hidden="true"></i></abbr> <?=$pemesan->nomor_telepon?><br>
                    <abbr title="Surel"><i class="fa fa-envelope" aria-hidden="true"></i></abbr> <a href="mailto:<?=$pemesan->nama?>"><?=$pemesan->nama?></a>
                </address>
            </div>
            <div class="col-md-7">
                <?php
                if ($tagihan->status == 'paid' || $tagihan->status == 'confirmed')
                {
                    echo form_open('admin/tagihan/konfirmasi/' . $tagihan->id_invoice, ['class' => 'form-horizontal']);
                ?>
                    <div class="form-group">
                      <input type="hidden" name="id_produk" value="">
                        <label class="col-sm-4 control-label">Jasa Pengiriman <p class="help-block"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Pembeli memilih <?=$kurirterpilih?></p> <br>

                          <p class="text-center">Paket Tarif Pengiriman </p>
                          <p class="text-center"><?=$paket_tarif_pengiriman?></p>
                        </label>
                        <div class="col-sm-8">
                            <div class="radio">
                                <label><input type="radio" class="form_control" name="jasapengiriman" value="JNE" <?=set_radio('jasapengiriman', 'JNE', ($jasapengiriman == 'JNE'))?> required> <abbr title="PT. Tiki Jalur Nugraha Ekakurir">JNE</abbr></label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" class="form_control" name="jasapengiriman" value="Tiki" <?=set_radio('jasapengiriman', 'Tiki', ($jasapengiriman == 'Tiki'))?> required> <abbr title="CV. Titipan Kilat">Tiki</abbr></label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" class="form_control" name="jasapengiriman" value="Pos Indonesia" <?=set_radio('jasapengiriman', 'Pos Indonesia', ($jasapengiriman == 'Pos Indonesia'))?> required> <abbr title="Pos Indonesia">Pos Indonesia</abbr></label>
                                </div>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="nomorResi" class="col-sm-4 control-label">Nomor Pengiriman (Resi)</label>
                        <div class="col-sm-8">
                            <input type="text" id="nomorResi" name="nomorpengiriman" class="form-control" value="<?=htmlspecialchars($nomorpengiriman)?>" maxlength="32" required>
                        </div>
                    </div>
                    <div class="col-sm-offset-4 col-sm-8">
                        <div class="btn-group" role="group" aria-label="Kontrol Pengiriman">
                            <a href="<?=site_url('admin/tagihan/detail/' . $tagihan->id_invoice)?>" class="btn btn-default" role="button"><i class="fa fa-chevron-left" aria-hidden="true"></i> Kembali</a>
                            <?php
                            if ($tagihan->status == 'confirmed')
                            {
                            ?>
                                <button type="submit" class="btn btn-success"><i class="fa fa-truck" aria-hidden="true"></i> Perbarui Informasi Pengiriman</button>
                            <?php
                            }
                            else
                            {
                            ?>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-truck" aria-hidden="true"></i> Tandai Telah Dikirim</button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php
                    echo form_close();
                    echo '<br><br><br>';
                    if ($tagihan->status == 'confirmed')
                    {
                        echo form_open('https://cekresi.com', ['method' => 'get', 'class' => 'form-horizontal', 'target' => '_blank']);
                ?>
                        <div class="form-group">
                            <label for="inputCekResi" class="col-sm-4 control-label">Cek Resi</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="inputCekResi" name="noresi" placeholder="Masukkan nomor resi..." value="<?=htmlspecialchars($nomorpengiriman)?>">
                                    <span class="input-group-btn"><button type="submit" class="btn btn-warning"><u class="fa fa-external-link" aria-hidden="true"></u> Cek Resi</button></span>
                                </div>
                                <span class="help-block">Disedikaan oleh <a href="https://cekresi.com" target="_BLANK" rel="nofollow, noopener">cekresi.com</a></span>
                            </div>
                        </div>
                <?php
                        echo form_close();
                    }
                }
                else
                {
                    echo
                        '<p class="lead bg-warning>Maaf, tagihan ini belum dibayar</p>',
                        anchor('admin/tagihan/detail/' . $tagihan->id_invoice, '<i class="fa fa-chevron-left" aria-hidden="true"></i> Kembali', ['class' => 'btn btn-default', 'role' => 'button']); 
                }
            }
            else
            {
                echo '<p class="lead bg-danger>Maaf, tagihan ini tidak memiliki pemesan</p>';
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
