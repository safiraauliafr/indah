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
    <script src="<?=base_url('assets/backend/lib/jquery/jquery.min.js', '')?>"></script>

  <script src="<?=base_url('assets/backend/lib/bootstrap/js/bootstrap.min.js', '')?>"></script>


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
    <!--header start--><header class="header black-bg">
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
            <a class="active" href="<?=base_url('admin/user', '')?>">
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
     <h1 class="text-center">Tambah User</h1>
    <div class="row">
      <div class="col-sm-9 col-sm-offset-1">
        <?php
        echo validation_errors('<div class="alert alert-danger">', '</div>');
        $this->view('frontend/flashalert');
        ?>
        <h3 class="text-center">Informasi Pelanggan Baru</h3>
        <?=form_open('admin/user/tambah', ['class' => 'form-horizontal'])?>
          <div class="form-group">
            <label for="namaDepan" class="col-sm-3 control-label">Nama Depan</label>
            <div class="col-sm-9">
              <input type="text" maxlength="64" class="form-control" id="namaDepan" name="namadepan" value="<?=set_value('namadepan')?>" placeholder="First Name" required>
            </div>
          </div>
          <div class="form-group">
            <label for="namaBelakang" class="col-sm-3 control-label">Nama Belakang</label>
            <div class="col-sm-9">
              <input type="text" maxlength="64" class="form-control" id="namaBelakang" name="namabelakang" value="<?=set_value('namabelakang')?>" placeholder="Last Name">
            </div>
          </div>
          <div class="form-group">
            <label for="namaPengguna" class="col-sm-3 control-label">Alamat Email</label>
            <div class="col-sm-9">
              <input type="email" maxlength="64" class="form-control" id="namaPengguna" name="nama" value="<?=set_value('nama')?>" placeholder="user@email.com" required>
              <span class="help-block">Alamat surel digunakan sebagai nama pengguna anda untuk masuk nanti</span>
            </div>
          </div>
          <div class="form-group">
            <label for="nomorTelepon" class="col-sm-3 control-label">Nomor Telepon</label>
            <div class="col-sm-9">
              <input type="tel" maxlength="24" class="form-control" id="nomortelepon" name="nomortelepon" value="<?=set_value('nomortelepon')?>" placeholder="+6281234567" pattern="^(\+|[0])[0-9]+$" required>
            </div>
          </div>
          <div class="form-group">
            <label for="kataSandi" class="col-sm-3 control-label">Password</label>
            <div class="col-sm-9">
              <input type="password" maxlength="32" class="form-control" id="kataSandi" name="password" value="<?=set_value('password')?>" required>
              <span class="help-block">Setidaknya harus terdiri dari 6 karakter atau lebih</span>
            </div>
          </div>
          <div class="form-group">
            <label for="konfirmasiKataSandi" class="col-sm-3 control-label">Konfirmasi Password</label>
            <div class="col-sm-9">
              <input type="password" maxlength="32" class="form-control" id="konfirmasiKataSandi" name="konfirmasipassword" required>
              <span class="help-block">Ketik ulang kata sandi</span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Tanggal Lahir</label>
            <div class="col-sm-2">
              <select name="tanggallahir" class="form-control" required>
                <option value="" disabled selected hidden>Tanggal</option>
                <?php
                for ($i = 1; $i <= 31; $i++)
                {
                  echo '<option ', set_select('tanggallahir', $i), '>', $i, '</option>';
                }
                ?>
              </select>
            </div>
            <div class="col-sm-4">
              <select name="bulanlahir" class="form-control" required>
                <option value="" disabled selected hidden>Bulan</option>
                <?php
                for ($i = 1; $i <= 12; $i++)
                {
                  echo '<option value="', $i, '" ', set_select('bulanlahir', $i), '>', date('F', mktime(0, 0, 0, $i, 10)), '</option>';
                }
                ?>
              </select>
            </div>
            <div class="col-sm-3">
              <select name="tahunlahir" class="form-control" required>
                <option value="" disabled selected hidden>Tahun</option>
              <?php
                $firstyear = date('Y', strtotime("-100 years"));
                for ($i = date('Y'); $i >= $firstyear; $i--)
                {
                  echo '<option ', set_select('tahunlahir', $i), '>', $i, '</option>';
                }
                ?>
              </select>
            </div>
          </div>
          
          <div class="form-group">
            <label for="jenisKelamin" class="col-sm-3 control-label">Jenis Kelamin</label>
            <div class="col-sm-9">
              <select name="jeniskelamin" class="form-control" id="jenisKelamin" required>
                <option value="" disabled selected hidden>Pilih Gender</option>
                <option value="L" <?=set_select('jeniskelamin', 'L')?>>Laki-laki</option>
                <option value="P" <?=set_select('jeniskelamin', 'P')?>>Perempuan</option>
              </select>
            </div>
          </div>
           <div class="form-group">
            <label for="jenisKelamin" class="col-sm-3 control-label">Grup</label>
            <div class="col-sm-9">
              <select name="grup" class="form-control" id="grup" required>
                <option value="" disabled selected hidden>Pilih Grup User </option>
                <option value="1" <?=set_select('grup', '1')?>>Pelanggan</option>
                <option value="2" <?=set_select('grup', '2')?>>Admin</option>
              </select>
            </div>
          </div>

             <div class="form-group">
                        <label for="alamat" class="col-sm-3 control-label">Alamat</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="provinsi" name="provinsi" required>
                                <option >Provinsi / Daerah</option>
                                <?php foreach($provinces as $provinsi): ?>
                                <option value="<?=$provinsi->id?>"><?=$provinsi->name?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" id="kota" name="kota" required>
                                <option>Kota / Kabupaten</option>
                                  <script>
                                    $(document).ready(function(){
                                        $("#provinsi").change(function (){
                                            var url = "<?php echo site_url('admin/user/get_regencies');?>/"+$(this).val();
                                            $('#kota').load(url);
                                            return false;
                                        });
                                      });
                                </script>

                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" id="kecamatan" name="kecamatan" required>
                                <option >Kecamatan / Distrik</option>
                                  <script>
                                    $(document).ready(function(){
                                        $("#kota").change(function (){
                                            var url = "<?php echo site_url('admin/user/get_districts');?>/"+$(this).val();
                                            $('#kecamatan').load(url);
                                            return false;
                                        });
                                      });
                                </script>

                            </select>
                        </div>
                    </div>
                      <div class="form-group">
            <label class="col-sm-3 control-label">Kode Pos</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" id="kode_pos" name="kode_pos" value="<?=set_value('kode_pos')?>" placeholder="13310" required>
            </div>
          </div>
            <div class="form-group">
            <label for="nomorTelepon" class="col-sm-3 control-label">Alamat Lengkap</label>
            <div class="col-sm-9">
              <textarea class="form-control" name="alamat" placeholder="Masukkan alamat lengkap anda" required></textarea>            
            </div>
          </div>



          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
              <input type="submit" class="btn btn-primary" value="Daftar">
            </div>
          </div>
        <?=form_close()?>
        </div>
    </div>
    <br>
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
