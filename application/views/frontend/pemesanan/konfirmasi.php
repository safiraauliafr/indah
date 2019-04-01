<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$kurirterpilih = '';
$jasapengiriman = '';
$nomorpengiriman = '';

if (!empty($tagihan->jasa_pengiriman))
{
    $kurirterpilih = $tagihan->jasa_pengiriman;
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

<div class="container">
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
                        <label class="col-sm-4 control-label">Jasa Pengiriman <p class="help-block"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Pembeli memilih <?=$kurirterpilih?></p></label>
                        <div class="col-sm-8">
                            <div class="radio">
                                <label><input type="radio" class="form_control" name="jasapengiriman" value="JNE" <?=set_radio('jasapengiriman', 'JNE', ($jasapengiriman == 'JNE'))?> required> <abbr title="PT. Tiki Jalur Nugraha Ekakurir">JNE</abbr></label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" class="form_control" name="jasapengiriman" value="Tiki" <?=set_radio('jasapengiriman', 'Tiki', ($jasapengiriman == 'Tiki'))?> required> <abbr title="CV. Titipan Kilat">Tiki</abbr></label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" class="form_control" name="jasapengiriman" value="J&T" <?=set_radio('jasapengiriman', 'J&T', ($jasapengiriman == 'J&T'))?> required> <abbr title="PT. Global Jet Express">J&T</abbr></label>
                                </div>
                            <div class="radio">
                                <label><input type="radio" class="form_control" name="jasapengiriman" value="Wahana" <?=set_radio('jasapengiriman', 'Wahana', ($jasapengiriman == 'Wahana'))?> required> <abbr title="PT. Wahana Prestasi Logistik">Wahana</abbr></label>
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
</div>