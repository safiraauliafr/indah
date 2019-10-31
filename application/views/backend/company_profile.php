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
                        <a class="active" href="<?= base_url('admin/company_profile', '') ?>">
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
                    <div class="col-lg-12 mt">
                        <div id="edit" class="tab-pane">
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2 detailed">
                                    <h4 class="mb">Profil Perusahaan</h4>
                                    <form id="form" role="form" class="form-horizontal" class="form-horizontal"
                                        method="post" enctype="multipart/form-data"
                                        action="<?php echo base_url('admin/company_profile/update_company'); ?>">

                                        <?php foreach ($company as $company1) : ?>
                                        <div class="form-group">
                                            <div class="col-md-12 text-center">
                                                <img class="img-circle"
                                                    src="<?= base_url('assets/uploads/', '') ?><?php echo $company1->logo; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Logo Perusahaan</label>
                                            <div class="col-lg-8">
                                                <input type="file" id="logo" name="logo" class="form-control"
                                                    value="<?php echo $company1->logo; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Nama Toko Online</label>
                                            <div class="col-lg-8">
                                                <input type="text" placeholder="Masukkan Nama Toko Online" id="nama"
                                                    name="nama" class="form-control"
                                                    value="<?php echo $company1->nama; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Email</label>
                                            <div class="col-lg-8">
                                                <input type="text" placeholder="Masukkan Email" id="email" name="email"
                                                    class="form-control" value="<?php echo $company1->email; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Provinsi</label>
                                            <div class="col-lg-8">
                                                <select class="form-control" id="sel1" name="id_provinsi">
                                                    <option value="<?php echo $company1->id_provinsi; ?>"> Pilih
                                                        Provinsi</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <p id="text_provinsi"></p>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Kota</label>
                                            <div class="col-lg-8">
                                                <select class="form-control" id="sel2" name="id_kota" disabled>
                                                    <option value="<?php echo $company1->id_kota; ?>"> Pilih Kota
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <p id="text_kota"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Alamat</label>
                                            <div class="col-lg-8">
                                                <textarea type="text" placeholder="Masukkan Alamat" id="alamat"
                                                    name="alamat"
                                                    class="form-control"><?php echo $company1->alamat; ?></textarea>
                                            </div>
                                        </div>
                                        <?php endforeach ?>
                                        <h4 class="mb">Rekening</h4>
                                        <?php
                    /*if ($rekeningArray == '') {
                              echo '<div class="form-group fieldGroup">
                              <div class="input-group">
                                <input type="text" name="rekening[]" class="form-control" placeholder="BRI - 0123123131 - Atas Nama aaa" value=""/>
                                <div class="input-group-addon"> 
                                    <a href="javascript:void(0)" class="btn btn-success addMore">+</a>
                                </div>
                            </div>
                              </div>'; 
                                echo '<div class="form-group fieldGroupCopy" style="display: none;">
                                    <div class="input-group col-lg-12">
                                        <input type="text" name="rekening[]" class="form-control" placeholder="BRI - 0123123131 - Atas Nama aaa" value=""/>
                                        <div class="input-group-addon"> 
                                            <a href="javascript:void(0)" class="btn btn-danger remove">X</a>
                                        </div>
                                    </div>
                                </div>'; 

                            }else{
                            for ($i=0; $i <1 ; $i++) { 
                            echo '<div class="form-group fieldGroup">
                              <div class="input-group">
                                <input type="text" name="rekening[]" class="form-control" placeholder="BRI - 0123123131 - Atas Nama aaa" value="'.$rekeningArray[$i].'"/>
                                <div class="input-group-addon"> 
                                    <a href="javascript:void(0)" class="btn btn-success addMore">+</a>
                                </div>
                            </div>
                              </div>';

                            }
                            for ($i=1; $i <count($rekeningArray) ; $i++) { 
                                        echo '<div class="form-group fieldGroupCopy" style="display: none;">
                                    <div class="input-group col-lg-12">
                                        <input type="text" name="rekening[]" class="form-control" placeholder="BRI - 0123123131 - Atas Nama aaa" value="'.$rekeningArray[$i].'"/>
                                        <div class="input-group-addon"> 
                                            <a href="javascript:void(0)" class="btn btn-danger remove">X</a>
                                        </div>
                                    </div>
                                </div>';
                            }
                           } */ ?>

                                        <div class="form-group">
                                            <div id="rekening2" style="margin-left: 120px;">


                                                <?php
                        foreach ($company as $data1) {
                          if ($data1->rekening != '') {
                            $rekeningArray = explode(",", $data1->rekening);
                            $count = 1;

                            for ($i = 0; $i < count($rekeningArray); $i++) {
                              $button = '';
                              if ($count > 1) {
                                $button = '<button type="button" name="remove" id="' . $count . '" class="btn btn-danger btn-xs remove" ">x</button>';
                              } else {
                                $button = '<button type="button" name="remove" id="' . $count . '" class="btn btn-danger btn-xs remove" ">x</button>';
                              }
                              echo '<div id="row' . $count . '"><div class="form-group" style="margin: 5px;"><div id="rekening2"><div class="col-lg-8"><input type="text" placeholder="BRI - 0123123131 - Atas Nama aaa" id="rekening" name="rekening[]" class="form-control" style="margin-bottom : 10px" value="' . $rekeningArray[$i] . '"> </div><div class="col-lg-1">' . $button . '</div></div></div></div>';
                              $count++;
                            }
                          }
                        }
                        ?>
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label class="col-lg-2 control-label"></label>
                                            <div class="col-lg-8 text-center">
                                                <p>Format Rekening : Nama Bank - Nomor Rekening - Atas Nama</p>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <button class="btn btn-theme" type="submit" id="submit">Save</button>
                                                <button class="btn btn-theme04" type="button">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /col-lg-8 -->
                                <!-- copy of input fields group -->
                            </div>
                            <!-- /row -->
                        </div>

                        <!-- /col-lg-12 -->
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
    <script type="text/javascript">
    /*  function save(){
      var file_data = $('#logo').prop('files')[0];
      var nama = $('#nama').val();
      var email =  $('#email').val();
      var provinsi =  $('#sel1').val();
      var kota =  $('#sel2').val();
      var alamat =  $('#alamat').val();
      var rekening =  $('#rekening').val();
      var form_data = new FormData();


      form_data.append('logo', file_data);    
      form_data.append('nama', nama);    
      form_data.append('email', email);    
      form_data.append('id_provinsi', provinsi);    
      form_data.append('id_kota', kota);    
      form_data.append('alamat', alamat);    
      form_data.append('rekening', rekening);   
    $.ajax({
      url:"<?php // echo site_url('admin/company_profile/update_company')
            ?>",
      type: "POST",
      dataType: "JSON",
      data: form_data,
      processData:false,
      contentType:false,
      cache:false,
      async:false,

      success:function(data)
      {
            if (data.status!='error') {
                    //location.reload();
                        console.log(data);
                        alert(data);
                    }else{
                      console.log(data.msg);
                        alert(data.msg);
                    }
        //alert(data);
        location.reload();// for reload a page      
      },
      error: function (jqXHR, textStatus, errorThrown) {
                alert("get session failed " + errorThrown);
            }
    });
  }*/
    </script>
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

    <script type="text/javascript">
    function getLokasi() {
        var $op = $("#sel1");

        $.getJSON("company_profile/provinsi", function(data) {
            $.each(data, function(i, field) {

                $op.append('<option value="' + field.province_id + '">' + field.province + '</option>');

            });

        });

    }

    getLokasi();

    $("#sel1").on("change", function(e) {
        e.preventDefault();
        var option = $('option:selected', this).val();
        $('#sel2 option:gt(0)').remove();
        $('#kurir').val('');

        if (option === '') {
            alert('null');
            $("#sel2").prop("disabled", true);
            $("#kurir").prop("disabled", true);
        } else {
            $("#sel2").prop("disabled", false);
            getKota(option);
        }
    });
    var text_provinsi = $('#sel1').val();
    if (text_provinsi != null) {
        $.getJSON("company_profile/kota/" + text_provinsi, function(data) {
            $.each(data, function(i, field) {
                document.getElementById("text_provinsi").innerHTML = field.province;
                document.getElementById("text_kota").innerHTML = field.city_name;
            });

        });

    }

    function getKota(idpro) {
        var $op = $("#sel2");

        $.getJSON("company_profile/kota/" + idpro, function(data) {
            $.each(data, function(i, field) {


                $op.append('<option value="' + field.city_id + '">' + field.type + ' ' + field
                    .city_name + '</option>');

            });

        });

    }
    var count = 1;

    function add_dynamic_input_field(count) {
        var button = '';
        if (count > 1) {
            button = '<button type="button" name="remove" id="' + count +
                '" class="btn btn-danger btn-xs remove" ">x</button>';
        } else {
            button = '<button type="button" name="add_more" id="add_more" class="btn btn-success btn-xs" ">+</button>';
        }
        output = '<div id="row' + count + '">';
        output +=
            '<div class="form-group" style="margin: 5px;"><div id="rekening2"><div class="col-lg-8"><input type="text" placeholder="BRI - 0123123131 - Atas Nama aaa" id="rekening" name="rekening[]" class="form-control" style="margin-bottom : 10px"> </div><div class="col-lg-1">' +
            button + '</div></div></div></div>';

        $('#rekening2').append(output);
    }
    add_dynamic_input_field(count);
    /*$('#sub').submit(function(e){
    e.preventDefault(); 
         $.ajax({
             url::"<?php //echo site_url('admin/company_profile/update_company')
                    ?>",
             type:"post",
             data:new FormData(this),
             processData:false,
             contentType:false,
             cache:false,
             async:false,
              success: function(data){
                  alert(data);
           }
         });
    }); */


    var ct = 1;

    function new_pemeliharaan() {
        ct++;
        var div1 = document.createElement('div');
        div1.id = ct;
        // link to delete extended form elements
        var delLink = '<div style="text-align:right;margin-right:65px"><a href="javascript:delIt(' + ct +
            ')">Hapus</a></div>';
        div1.innerHTML = document.getElementById('rekening3').innerHTML + delLink;
        document.getElementById('rekening2').appendChild(div1);
    }
    // function to delete the newly added set of elements
    function delIt(eleId) {
        d = document;
        var ele = d.getElementById(eleId);
        var parentEle = d.getElementById('rekening2');
        parentEle.removeChild(ele);
    }


    $(document).on('click', '#add_more', function() {
        count = count + 1;
        add_dynamic_input_field(count);
    });

    $(document).on('click', '.remove', function() {
        var row_id = $(this).attr("id");
        $('#row' + row_id).remove();
    });
    /* function ambil_rekening(){
  
    $.ajax({
        url : "<?php echo base_url('admin/company_profile/ambil_rekening') ?>",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('#rekening2').html(data.rekeningHtml);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax' + errorThrown);
        }
    });

}*/




    /*$(document).ready(function(){
    //group add limit
    var maxGroup = 20;
    
    //add more fields group
    $(".addMore").click(function(){
        if($('body').find('.fieldGroup').length < maxGroup){
            var fieldHTML = '<div class="form-group fieldGroup">'+$(".fieldGroupCopy").html()+'</div>';
            $('body').find('.fieldGroup:last').after(fieldHTML);
        }else{
            alert('Maximum '+maxGroup+' groups are allowed.');
        }
    });
    
    //remove fields group
    $("body").on("click",".remove",function(){ 
        $(this).parents(".fieldGroup").remove();
    });
});*/
    </script>
</body>

</html>