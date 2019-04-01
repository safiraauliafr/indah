<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$nama = $akun->nama;
$namadepan = $akun->nama_depan;
$namabelakang = $akun->nama_belakang;
$jeniskelamin = $akun->jenis_kelamin;
$nomortelepon = $akun->nomor_telepon;
$tgllahir = strtotime($akun->tanggal_lahir);
$tanggallahir = date('d', $tgllahir);
$bulanlahir = date('m', $tgllahir);
$tahunlahir = date('Y', $tgllahir);
$idprovinsi = $akun->province_id;
$alamat = $akun->alamat;
$kodepos = $akun->kode_pos;

if ($this->input->post('is_submitted'))
{
	$namadepan = set_value('namadepan');
	$namabelakang = set_value('namabelakang');
	$nomortelepon = set_value('nomortelepon');
	$idprovinsi = set_value('provinsi');
	$alamat = set_value('alamat');
	$kodepos = set_value('kodepos');

	$nama = set_value('nama');
}
?>

	<div class="container">
		<h1>Pengaturan Akun</h1>
		<div class="row">
			<div class="col-sm-9 col-sm-offset-1">
				<?php
				echo validation_errors('<div class="alert alert-danger">', '</div>');
				$this->view('frontend/flashalert');
				?>
				<fieldset>
					<legend>Informasi Pelanggan</legend>
					<?=form_open('akun', ['class' => 'form-horizontal'])?>
						<div class="form-group">
							<label for="namaDepan" class="col-sm-3 control-label">Nama Depan</label>
							<div class="col-sm-9">
								<input type="text" maxlength="64" class="form-control" id="namaDepan" name="namadepan" value="<?=htmlspecialchars($namadepan)?>" placeholder="First Name" required>
							</div>
						</div>
						<div class="form-group">
							<label for="namaBelakang" class="col-sm-3 control-label">Nama Belakang</label>
							<div class="col-sm-9">
								<input type="text" maxlength="64" class="form-control" id="namaBelakang" name="namabelakang" value="<?=htmlspecialchars($namabelakang)?>" placeholder="Last Name">
							</div>
						</div>
						<div class="form-group">
							<label for="jenisKelamin" class="col-sm-3 control-label">Jenis Kelamin</label>
							<div class="col-sm-9">
								<select class="form-control" id="jenisKelamin" readonly>
									<option value="L" <?=(($jeniskelamin == 'L') ? 'selected' : '')?>>Laki-laki</option>
									<option value="P" <?=(($jeniskelamin == 'P') ? 'selected' : '')?>>Perempuan</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Tanggal Lahir</label>
							<div class="col-sm-2">
								<select class="form-control" readonly>
									<?php
									for ($i = 1; $i <= 31; $i++)
									{
										echo '<option ', (($i == $tanggallahir) ? 'selected' : ''), '>', $i, '</option>';
									}
									?>
								</select>
							</div>
							<div class="col-sm-4">
								<select class="form-control" readonly>
									<?php
									for ($i = 1; $i <= 12; $i++)
									{
										echo '<option value="', $i, '" ', (($i == $bulanlahir) ? 'selected' : ''), '>', date('F', mktime(0, 0, 0, $i, 10)), '</option>';
									}
									?>
								</select>
							</div>
							<div class="col-sm-3">
								<select class="form-control" readonly>
									<option selected></option>
								<?php
									$firstyear = date('Y', strtotime("-100 years"));
									for ($i = date('Y'); $i >= $firstyear; $i--)
									{
										echo '<option ', (($i == $tahunlahir) ? 'selected' : ''), '>', $i, '</option>';
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="nomorTelepon" class="col-sm-3 control-label">Nomor Telepon</label>
							<div class="col-sm-9">
								<input type="tel" maxlength="24" class="form-control" id="nomorTelepon" name="nomortelepon" value="<?=htmlspecialchars($nomortelepon)?>" placeholder="+6281234567" pattern="^(\+|[0])[0-9]+$" required>
							</div>
						</div>
						<div class="form-group">
							<label for="alamatUtama" class="col-sm-3 control-label">Alamat Utama</label>
							<div class="col-sm-3">
								<select class="form-control" id="provinsi" name="provinsi" required>
									<option value="" disabled selected hidden>Provinsi / Daerah</option>
									<?php foreach($provinces as $provinsi): ?>
									<option value="<?=$provinsi->id?>" <?=set_select('provinsi', $provinsi->id, ($provinsi->id == $idprovinsi))?>><?=$provinsi->name?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-sm-3">
								<select class="form-control" id="kota" name="kota">
									<option >Kota / Kabupaten</option>
									<script>
                                    $(document).ready(function(){
                                        $("#provinsi").change(function (){
                                            var url = "<?php echo site_url('akun/get_regencies');?>/"+$(this).val();
                                            $('#kota').load(url);
                                            return false;
                                        });
                                      });
                                </script>
								</select>
							</div>
							<div class="col-sm-3">
								<select class="form-control" id="kecamatan" name="kecamatan">
									<option >Kecamatan / Distrik</option>
									    <script>
                                    $(document).ready(function(){
                                        $("#kota").change(function (){
                                            var url = "<?php echo site_url('akun/get_districts');?>/"+$(this).val();
                                            $('#kecamatan').load(url);
                                            return false;
                                        });
                                      });
                                </script>

								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<textarea class="form-control" style="resize: vertical;" id="alamatUtama" name="alamat" placeholder="<?=htmlspecialchars($alamat)?>" maxlength="255" required><?=htmlspecialchars($alamat)?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="kodePos" class="col-sm-3 control-label">Kode Pos</label>
							<div class="col-sm-9">
								<input type="number" class="form-control" id="kodePos" name="kodepos" placeholder="<?=htmlspecialchars($kodepos)?>" maxlength="8" value="<?=htmlspecialchars($kodepos)?>" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<input type="submit" class="btn btn-primary" value="Simpan">
								<button type="reset" class="btn btn-default">Atur ulang kembali form</button>
							</div>
						</div>

				<script type="text/javascript">
                alert("Registrasi berhasil !");
              	</script>

					<?=form_close()?>
				</fieldset>
				<fieldset>
					<legend>Informasi Akun</legend>
					<?=form_open('akun/perbarui', ['class' => 'form-horizontal'])?>
						<div class="form-group">
							<label for="namaPengguna" class="col-sm-3 control-label">Alamat Email</label>
							<div class="col-sm-9">
								<input type="email" maxlength="64" class="form-control" id="namaPengguna" name="nama" value="<?=htmlspecialchars($nama)?>" placeholder="user@email.com" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="kataSandi" class="col-sm-3 control-label">Password</label>
							<div class="col-sm-9">
								<input type="password" maxlength="32" class="form-control" id="kataSandi" name="password" value="<?=set_value('password')?>" required>
								<span class="help-block">Masukkan password anda saat ini</span>
							</div>
						</div>
						<div class="form-group">
							<label for="kataSandi" class="col-sm-3 control-label">Password Baru</label>
							<div class="col-sm-9">
								<input type="password" maxlength="32" class="form-control" id="kataSandiBaru" name="newpassword" value="<?=set_value('newpassword')?>" required>
								<span class="help-block">Setidaknya harus terdiri dari 6 karakter atau lebih</span>
							</div>
						</div>
						<div class="form-group">
							<label for="konfirmasiKataSandi" class="col-sm-3 control-label">Konfirmasi Password Baru</label>
							<div class="col-sm-9">
								<input type="password" maxlength="32" class="form-control" id="konfirmasiKataSandi" name="confirmpassword" value="<?=set_value('confirmpassword')?>" required>
								<span class="help-block">Ketik ulang kata sandi baru</span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<input type="submit" class="btn btn-primary" value="Simpan">
								<button type="reset" class="btn btn-default">Batalkan</button>
							</div>
						</div>



					<?=form_close()?>
				</fieldset>
				<br>
			</div>
		</div>
		<br>
	</div>