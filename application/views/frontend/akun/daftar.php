<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="container">
    <h1>Mendaftar</h1>
    <div class="row">
        <div class="col-sm-9 col-sm-offset-1">
            <?php
            echo validation_errors('<div class="alert alert-danger">', '</div>');
            $this->view('frontend/flashalert');
            ?>
            <h3>Informasi Pelanggan Baru</h3>
            <?= form_open('akun/daftar', ['class' => 'form-horizontal']) ?>
            <div class="form-group">
                <label for="namaDepan" class="col-sm-3 control-label">Nama Depan</label>
                <div class="col-sm-9">
                    <input type="text" maxlength="64" class="form-control" id="namaDepan" name="namadepan"
                        value="<?= set_value('namadepan') ?>" placeholder="First Name" required>
                </div>
            </div>
            <div class="form-group">
                <label for="namaBelakang" class="col-sm-3 control-label">Nama Belakang</label>
                <div class="col-sm-9">
                    <input type="text" maxlength="64" class="form-control" id="namaBelakang" name="namabelakang"
                        value="<?= set_value('namabelakang') ?>" placeholder="Last Name">
                </div>
            </div>
            <div class="form-group">
                <label for="namaPengguna" class="col-sm-3 control-label">Alamat Email</label>
                <div class="col-sm-9">
                    <input type="email" maxlength="64" class="form-control" id="namaPengguna" name="nama"
                        value="<?= set_value('nama') ?>" placeholder="user@email.com" required>
                    <span class="help-block">Alamat surel digunakan sebagai nama pengguna anda untuk masuk nanti</span>
                </div>
            </div>
            <div class="form-group">
                <label for="nomorTelepon" class="col-sm-3 control-label">Nomor Telepon</label>
                <div class="col-sm-9">
                    <input type="tel" maxlength="24" class="form-control" id="nomor_telepon" name="nomor_telepon"
                        value="<?= set_value('nomortelepon') ?>" placeholder="+6281234567" pattern="^(\+|[0])[0-9]+$"
                        required>
                </div>
            </div>
            <div class="form-group">
                <label for="kataSandi" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-9">
                    <input type="password" maxlength="32" class="form-control" id="kataSandi" name="password"
                        value="<?= set_value('password') ?>" required>
                    <span class="help-block">Setidaknya harus terdiri dari 6 karakter atau lebih</span>
                </div>
            </div>
            <div class="form-group">
                <label for="konfirmasiKataSandi" class="col-sm-3 control-label">Konfirmasi Password</label>
                <div class="col-sm-9">
                    <input type="password" maxlength="32" class="form-control" id="konfirmasiKataSandi"
                        name="konfirmasipassword" required>
                    <span class="help-block">Ketik ulang kata sandi</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Tanggal Lahir</label>
                <div class="col-sm-2">
                    <select name="tanggallahir" class="form-control" required>
                        <option value="" disabled selected hidden>Tanggal</option>
                        <?php
                        for ($i = 1; $i <= 31; $i++) {
                            echo '<option ', set_select('tanggallahir', $i), '>', $i, '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-4">
                    <select name="bulanlahir" class="form-control" required>
                        <option value="" disabled selected hidden>Bulan</option>
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
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
                        for ($i = date('Y'); $i >= $firstyear; $i--) {
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
                        <option value="L" <?= set_select('jeniskelamin', 'L') ?>>Laki-laki</option>
                        <option value="P" <?= set_select('jeniskelamin', 'P') ?>>Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="alamat" class="col-sm-3 control-label">Alamat</label>
                <div class="col-sm-3">
                    <select class="form-control" id="provinsi" name="provinsi">
                        <option value="" disabled selected hidden>Provinsi / Daerah</option>

                        <!-- <option>Provinsi / Daerah</option> -->
                        <!-- <?php //foreach ($provinces as $provinsi) : 
                                ?>
                        <option value="<?php //$provinsi->id 
                                        ?>"><?php // $provinsi->name 
                                            ?></option>
						<?php //endforeach; 
                        ?> -->

                    </select>
                </div>
                <div class="col-sm-3">
                    <select class="form-control" id="kota" name="kota">
                        <option value="" disabled selected hidden>Kota / Kabupaten</option>

                        <!-- <option>Kota / Kabupaten</option> -->
                        <!-- <script>
                        $(document).ready(function() {
                            $("#provinsi").change(function() {
                                var url = "<?php //echo site_url('akun/get_regencies'); 
                                            ?>/" + $(this)
                                .val();
                                $('#kota').load(url);
                                return false;
                            });
                        });
                        </script> -->

                    </select>
                </div>
                <!-- <div class="col-sm-3">
                    <select class="form-control" id="kecamatan" name="kecamatan" required>
                        <option>Kecamatan / Distrik</option> -->
                <!-- <script>
                                    $(document).ready(function(){
                                        $("#kota").change(function (){
                                            var url = "<?php //echo site_url('akun/get_districts'); 
                                                        ?>/"+$(this).val();
                                            $('#kecamatan').load(url);
                                            return false;
                                        });
                                      });
                                </script> -->

                <!-- </select>
            </div> -->
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Kode Pos</label>
                <div class="col-sm-9">
                    <select class="form-control" name="kodepos" id="kodePos">
                        <option value="" disabled selected hidden>Kode Pos</option>
                    </select>

                    <!-- <input type="number" class="form-control" id="kode_pos" name="kode_pos"
						value="<?= set_value('kode_pos') ?>" placeholder="13310" required> -->

                </div>
            </div>
            <div class="form-group">
                <label for="nomorTelepon" class="col-sm-3 control-label">Alamat Lengkap</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="alamat" placeholder="Masukkan alamat lengkap anda"
                        required></textarea>
                </div>
            </div>



            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <input type="submit" class="btn btn-primary" value="Daftar">
                </div>
            </div>

            <?= form_close() ?>
            <br>
            <p class="lead">Sudah punya akun? <?= anchor('akun/masuk', 'Klik disini untuk masuk') ?></p>
            <br>

        </div>
    </div>
    <br>
</div>
<script type="text/javascript">
function getLokasi() {
    var $op = $("#provinsi");

    $.getJSON("<?= base_url() ?>akun/provinsi", function(data) {
        $.each(data, function(i, field) {
            $op.append('<option value="' + field.province_id + '">' + field.province + '</option>');

        });

    });

}

getLokasi();

$("#provinsi").on("change", function(e) {
    e.preventDefault();
    var option = $('option:selected', this).val();
    $('#kota option:gt(0)').remove();
    $('#kurir').val('');

    if (option === '') {
        alert('null');
        $("#kota").prop("disabled", true);
        $("#kurir").prop("disabled", true);
    } else {
        $("#kota").prop("disabled", false);
        $("#kurir").prop("disabled", false);
        getKota(option);
    }
});


function getKota(idpro) {
    var $op = $("#kota");

    $.getJSON("<?php echo base_url(); ?>akun/kota/" + idpro, function(data) {
        $.each(data, function(i, field) {
            $op.append('<option value="' + field.city_id + '">' + field.type + ' ' +
                field
                .city_name +
                '</option>');
        });

    });
}

// on change kota
$("#kota").on("change", function(e) {
    e.preventDefault();
    var option = $('option:selected', this).val();
    $('#kodePos').val('');

    if (option === '') {
        alert('null');
        $("#kota").prop("disabled", true);
        $("#kodePos").prop("disabled", true);
    } else {
        $("#kota").prop("disabled", false);
        $("#kodePos").prop("disabled", false);
        getKodepos(option);
    }
});

function getKodepos(idkota) {
    var $op = $("#kodePos");
    $('.opsi').remove();
    $.getJSON("<?php echo base_url(); ?>akun/kodepos/" + idkota, function(data) {
        var result = Object.entries(data);
        // console.log(result);
        $op.append('<option class="opsi" value="' + result[5][1] +
            '" selected="selected" disabled>' +
            result[5][1] +
            '</option>');
        $op.append('<input name="kodepos" class="opsi" type="text" value="' + result[5][1] +
            '">');
    });
}

$("#kurir").on("change", function(e) {
    e.preventDefault();
    var option = $('option:selected', this).val();
    var origin = $("#kota_asal").val();
    var des = $("#kota").val();
    var qty = $("#berat").val();

    if (qty === '0' || qty === '') {
        alert('null');
    } else if (option === '') {
        alert('null');
    } else {
        $("#tarif").prop("disabled", false);
        var select = document.getElementById('tarif');
        select.options.length = 1;
        getOrigin(origin, des, qty, option);
        //totalSemua();
    }
});
$("#tarif").on("change", function(e) {
    e.preventDefault();
    totalSemua();
});
</script>