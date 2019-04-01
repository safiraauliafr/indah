<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

	<div class="container">
		<h1>Periksa Belanjaan Anda</h1>
        <?php
        echo validation_errors('<div class="alert alert-danger">', '</div>');
        $this->view('frontend/flashalert');
        ?>
		<div class="row">
            <div class="col-md-12">
                <?php
                if ($this->cart->total_items())
                {
                ?>
                <table id="<?=$datatable?>" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th>Harga satuan</th>
                            <th>Jumlah</th>
                            <th>Sub-total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 0;
                    $totaljenis = 0;
                    $totalberat = 0;
                    foreach($this->cart->contents() as $item)
                    {
                        $totaljenis++;
                        $totalberat += $item['weight'] * $item['qty'];
                    ?>
                        <tr>
                            <td><?=anchor('produk/lihat/' . $item['id'], $item['name'])?></td>
                            <td class="text-right"><?=number_format($item['price'],0,'.',',')?></td>
                            <td><?=$item['qty']?> (<?=$item['weight'] * $item['qty']?> kg)</td>
                            <td class="text-right"><?=number_format($item['subtotal'],0,'.',',')?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
                <?=form_open('pemesanan/proses', ['class' => 'form-horizontal'])?>
                    <div class="form-group">
                        <label for="alamat" class="col-sm-2 control-label">Alamat pengiriman</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="provinsi" name="provinsi" required>
                                <option value="" disabled selected hidden>Provinsi / Daerah</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" id="kota" name="kota">
                                <option value="" disabled selected hidden>Kota / Kabupaten</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                            <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat pengiriman" maxlength="255" required><?=set_value('alamat', htmlspecialchars($pengguna->alamat))?></textarea>
                            <span class="help-block">Kunjungi halaman <?=anchor_popup('akun', 'pengaturan akun')?> untuk mengatur alamat utama secara permanen</span>
                        </div>
                        <div class="col-sm-4">
                            <address>
                                <strong><?=$pengguna->nama_depan?> <?=$pengguna->nama_belakang?></strong><br>
                                <abbr title="Telepon"><i class="fa fa-phone" aria-hidden="true"></i></abbr> <?=$pengguna->nomor_telepon?><br>
                                <abbr title="Surel"><i class="fa fa-envelope" aria-hidden="true"></i></abbr> <?=$pengguna->nama?>
                            </address>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kodePos" class="col-sm-2 control-label">Kode Pos</label>
                        <div class="col-sm-10">
                            <input type="number" id="kodePos" name="kodepos" class="form-control" value="<?=set_value('kodepos', $pengguna->kode_pos)?>" maxlength="8" required>
                        </div>
                    </div>
                      <div class="form-group">
                        <label for="metodePembayaran" class="col-sm-2 control-label">Metode Pembayaran</label>
                        <div class="col-sm-10">
                          <select name="metode_pembayaran" class="form-control">
                            <option>Pilih Bank</option>
                               <?php 
                                foreach($rekening as $rekening1)
                                { 
                                  echo '<option value="'.$rekening1.'">'.$rekening1.'</option>';
                                }
                            ?>
                          </select>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                              <p>Format : Nama Bank - Nomor Rekening - Atas Nama</p>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jasa Pengiriman</label>
                        <div class="col-sm-10">
                     <div class="form-group">  
                          <select class="form-control" id="kurir" disabled name="kurir">
                            <option value=""> Pilih Kurir</option>
                            <option value="jne">JNE</option>
                            <option value="tiki">TIKI</option>
                            <option value="pos">POS Indonesia</option>
                          </select>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Paket Tarif</label>
                        <div class="col-sm-10">
                            <div class="form-group">  
                              <select class="form-control" id="tarif" disabled name="tarif">
                                <option value=""> Pilih Tarif</option>
                              </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Total Barang</label>
                        <div class="col-sm-10">
                            <h4><?=$totaljenis?> jenis, <?=$this->cart->total_items()?> unit, <?=ceil($totalberat)?> <abbr title="kilogram">kg</abbr> <small>(dibulatkan ke atas dari berat mula <?=$totalberat?> kg untuk pengiriman)</small></h4>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Total Biaya Pembelian</label>
                        <div class="col-sm-10">
                            <h4><small><abbr title="Rupiah">Rp</abbr>.</small> <?=$this->cart->total()?></h4>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Total Pembelian + Ongkir</label>
                        <div class="col-sm-10">
                            <h4 id="total_beli_ongkir"></h4>
                        </div>
                    </div>
                     <?php foreach ($company as $company1) :?>
                    <input type="hidden" id="kota_asal" name="kota_asal" value="<?php echo $company1->id_kota;?>">                
                    <?php endforeach; ?>
                    <input type="hidden" name="berat" value="<?=$totalberat?>" id="berat">
                    <input type="hidden" name="total_semua_pembelian" value="" id="total_semua_pembelian">

                    <input type="hidden" name="total_biaya_pembelian" id="total_biaya_pembelian" value="<?=$this->cart->total()?>">
                    <div class="btn-group" role="group" aria-label="Kontrol Keranjang">
                        <?=
                        anchor('produk/kosongkan_keranjang', '<i class="fa fa-times" aria-hidden="true"></i> Batalkan', ['class' => 'btn btn-danger btn-lg', 'role' => 'button', 'onclick' => 'return promptDeleteAll()']),
                        anchor('produk/keranjang','<i class="fa fa-cart-arrow-down" aria-hidden="true"></i> Kembali ke keranjang', ['class' => 'btn btn-default btn-lg', 'role' => 'button']);
                        ?>
                        <button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-money" aria-hidden="true"></i> Lakukan Pemesanan</button>
                    </div>

                <?=form_close()?>
       
                
                <script>
                    function promptDeleteAll() {
                        return confirm("Apakah anda yakin ingin menghapus semua " + <?=$this->cart->total_items()?> + " barang dari keranjang belanja anda?");
                    }
                </script>
                <?php
                }
                else
                {
                ?>
                    <div class="alert alert-warning">Anda belum memiliki barang di keranjang belanja anda, <?=anchor('produk', 'silahkan pilih barang belanjaan terlebih dahulu')?>.</div>
                    <ul class="list-inline">
                        <li><strong>Lihat juga:</strong></li>
                        <li><?=anchor('pelanggan/sejarah_belanja', 'Sejarah Belanja Saya')?></li>
                        <li><?=anchor('pelanggan/konfirmasi_pembayaran', 'Konfirmasi Pembayaran Saya')?></li>
                    </ul>
                <?php
                }
                ?>
            </div>
		</div>
        <br>
	</div>
    <script type="text/javascript">
        function getLokasi() {
  var $op = $("#provinsi");
  
  $.getJSON("pemesanan/provinsi", function(data){  
    $.each(data, function(i,field){  
    
       $op.append('<option value="'+field.province_id+'">'+field.province+'</option>'); 

    });
    
  });
 
}

getLokasi();

$("#provinsi").on("change", function(e){
  e.preventDefault();
  var option = $('option:selected', this).val();    
  $('#kota option:gt(0)').remove();
  $('#kurir').val('');

  if(option==='')
  {
    alert('null');    
    $("#kota").prop("disabled", true);
    $("#kurir").prop("disabled", true);
  }
  else
  {        
    $("#kota").prop("disabled", false);
    $("#kurir").prop("disabled", false);
    getKota(option);
  }
});

function getKota(idpro) {
  var $op = $("#kota"); 
  
  $.getJSON("pemesanan/kota/"+idpro, function(data){      
    $.each(data, function(i,field){  
    

       $op.append('<option value="'+field.city_id+'">'+field.type+' '+field.city_name+'</option>'); 

    });
    
  });
 
}

$("#kurir").on("change", function(e){
  e.preventDefault();
  var option = $('option:selected', this).val();    
  var origin = $("#kota_asal").val();
  var des = $("#kota").val();
  var qty = $("#berat").val();

  if(qty==='0' || qty==='')
  {
    alert('null');
  }
  else if(option==='')
  {
    alert('null');        
  }
  else
  {
    $("#tarif").prop("disabled", false);  
    var select = document.getElementById('tarif');
    select.options.length = 1;              
    getOrigin(origin,des,qty,option);
    //totalSemua();
  }
});
$("#tarif").on("change", function(e){
  e.preventDefault();
  totalSemua();
});


function getOrigin(origin,des,qty,cour) {
  var i, j, x = "";
  var tarif = [];
  var waktu = [];
  var service = [];
  var select = document.getElementById('tarif');
  
  $.getJSON("pemesanan/tarif/"+origin+"/"+des+"/"+qty+"/"+cour, function(data){     
    $.each(data, function(i,field){        

      for(i in field.costs)
      {
          service.push(field.costs[i].description);

           for (j in field.costs[i].cost) {
                tarif.push(field.costs[i].cost[j].value);
                waktu.push(field.costs[i].cost[j].etd);
            }
         
      }
      for (var i = 0; i < tarif.length; i++) {
          var opt = service[i] +" | "+ " Rp. " + tarif[i] +" | "+ waktu[i] + " Hari";
          var el = document.createElement("option");
          el.textContent = opt;
          el.value = opt;
          select.append(el);
              }
    });
  });
 
}
function totalSemua(){
    var total_beli = $("#total_biaya_pembelian").val();
    var tarif =  $("#tarif").val();
    var aa = tarif.split(" | ");
    var total_beli_ongkir = parseInt(aa[1].replace("Rp. " , "")) + parseInt(total_beli);
    //tarif.split('Rp'[\s.]*(\d*));
    document.getElementById("total_beli_ongkir").innerHTML = "Rp. " + total_beli_ongkir;
    document.getElementById("total_semua_pembelian").value = total_beli_ongkir;
}



    </script>