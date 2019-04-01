<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$id = $produk->id_produk;
$nama = $produk->nama;
$harga = $produk->harga;
$persediaan = $produk->persediaan;
$berat = $produk->berat;
$panjang = $produk->panjang;
$lebar = $produk->lebar;
$tinggi = $produk->tinggi;
$deskripsi = $produk->deskripsi;
$gambar = $produk->gambar;

if ($this->input->post('is_submitted'))
{
	$nama = set_value('nama');
	$harga = set_value('harga');
	$persediaan = set_value('persediaan');
	$berat = set_value('berat');
	$panjang = set_value('panjang');
	$lebar = set_value('lebar');
	$tinggi = set_value('tinggi');
	$deskripsi = set_value('deskripsi');
}
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Edit Produk #<strong><?=$id?></strong></h1>
			<?php
			echo validation_errors('<div class="alert alert-danger">', '</div>');
			@print($error);
			echo form_open_multipart('admin/produk/edit/' . $id, ['class' => 'form-horizontal'])
			?>
				<div class="form-group">
					<label for="namaProduk" class="col-sm-2 control-label">Nama produk</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="namaProduk" name="nama" value="<?=htmlspecialchars($nama)?>" placeholder="<?=htmlspecialchars($nama)?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="hargaProduk" class="col-sm-2 control-label">Harga satuan produk</label>
					<div class="col-sm-10">
						<div class="input-group">
							<div class="input-group-addon"><abbr title="Rupiah">Rp</abbr></div>
							<input type="number" min="0" class="form-control" id="hargaProduk" name="harga" value="<?=$harga?>" placeholder="<?=$harga?>" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="beratProduk" class="col-sm-2 control-label">Dimensi produk</label>
					<div class="col-sm-2">
						<div class="input-group">
							<input type="number" min="0" step="0.1" class="form-control" id="beratProduk" name="berat" value="<?=$berat?>" placeholder="Berat" required>
							<div class="input-group-addon"><abbr title="kilogram">kg</abbr></div>
						</div>
					</div>
					<label for="panjangProduk" class="col-sm-2 control-label">Panjang / Lebar / Tinggi</label>
					<div class="col-sm-2">
						<div class="input-group">
							<input type="number" min="0" step="0.1" class="form-control" id="panjangProduk" name="panjang" value="<?=$panjang?>" placeholder="Panjang">
							<div class="input-group-addon"><abbr title="sentimeter">cm</abbr></div>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="input-group">
							<input type="number" min="0" step="0.1" class="form-control" id="lebarProduk" name="lebar" value="<?=$lebar?>" placeholder="Lebar">
							<div class="input-group-addon"><abbr title="sentimeter">cm</abbr></div>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="input-group">
							<input type="number" min="0" step="0.1" class="form-control" id="tinggiProduk" name="tinggi" value="<?=$tinggi?>" placeholder="Tinggi">
							<div class="input-group-addon"><abbr title="sentimeter">cm</abbr></div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="persediaanProduk" class="col-sm-2 control-label">Jumlah persediaan produk (stock)</label>
					<div class="col-sm-10">
						<input type="number" min="0" class="form-control" id="persediaanProduk" name="persediaan" value="<?=$persediaan?>" placeholder="<?=$persediaan?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="deskripsiProduk" class="col-sm-2 control-label">Deskripsi produk</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="deskripsiProduk" name="deskripsi" placeholder="<?=htmlspecialchars($deskripsi)?>" maxlength="255"><?=htmlspecialchars($deskripsi)?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="gambarProduk" class="col-sm-2 control-label">Gambar produk</label>
					<div class="col-sm-10">
						<?php if (!empty($gambar)) echo img(['src' => PRODUCT_UPLOAD_DIRECTORY . $gambar, 'alt' => $gambar, 'width' => 200, 'title' => 'Gambar produk saat ini']); ?>
						<input type="file" id="gambarProduk" name="gambar" accept="image/jpeg, image/png">
						<p class="help-block">Unggah satu foto dari produk yang akan dijual (format: .jpg, .jpeg, .png)</p>
					</div>
				</div>
				<div class="col-sm-10 col-sm-offset-2">
					<input type="hidden" name="is_submitted" value="1">
					<button type="submit" class="btn btn-primary">Simpan perubahan</button>
					<button type="reset" class="btn btn-default">Atur ulang kembali form</button>
				</div>
			<?=form_close()?>
			<br>
		</div>
	</div>
	<br>
</div>