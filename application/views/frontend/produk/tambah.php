<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Tambah Produk Baru</h1>
			<?php
			echo validation_errors('<div class="alert alert-danger">', '</div>');
			@print($error);
			echo form_open_multipart('admin/produk/tambah', ['class' => 'form-horizontal'])
			?>
				<div class="form-group">
					<label for="namaProduk" class="col-sm-2 control-label">Nama produk</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="namaProduk" name="nama" value="<?=set_value('nama')?>" placeholder="Nama" required>
					</div>
				</div>
				<div class="form-group">
					<label for="hargaProduk" class="col-sm-2 control-label">Harga satuan produk</label>
					<div class="col-sm-10">
						<div class="input-group">
							<div class="input-group-addon"><abbr title="Rupiah">Rp</abbr></div>
							<input type="number" min="0" class="form-control" id="hargaProduk" name="harga" value="<?=set_value('harga')?>" placeholder="Harga" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="persediaanProduk" class="col-sm-2 control-label">Jumlah persediaan produk (stock)</label>
					<div class="col-sm-10">
						<input type="number" min="0" class="form-control" id="persediaanProduk" name="persediaan" value="<?=set_value('persediaan')?>" placeholder="Persediaan" required>
					</div>
				</div>

				<div class="form-group">
					<label for="deskripsiProduk" class="col-sm-2 control-label">Deskripsi produk</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="deskripsiProduk" name="deskripsi" placeholder="Deskripsi" maxlength="255"><?=set_value('deskripsi')?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="gambarProduk" class="col-sm-2 control-label">Gambar produk</label>
					<div class="col-sm-10">
						<input type="file" id="gambarProduk" name="gambar" accept="image/jpeg, image/png" required>
						<p class="help-block">Unggah satu foto dari produk yang akan dijual (format: .jpg, .jpeg, .png)</p>
					</div>
				</div>
				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-primary">Tambahkan</button>
					<button type="reset" class="btn btn-default">Atur ulang kembali form</button>
				</div>
			<?=form_close()?>
			<br>
		</div>
	</div>
	<br>
</div>