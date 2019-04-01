<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<h1>Konfirmasi Pembayaran</h1>
					<?php
					echo validation_errors('<div class="alert alert-danger">', '</div>');
					$this->view('frontend/flashalert');
					@print($error);
					foreach ($invoice as $invoice1) {
						echo form_open_multipart('pelanggan/konfirmasi_pembayaran/'.$invoice1->id_invoice, ['class' => 'form-horizontal']);

					}
					?>
						<div class="form-group">
							<label for="nomorTagihan" class="col-sm-2 control-label">Nomor tagihan</label>
							<div class="col-sm-10">
								<input type="number" min="0" class="form-control" id="nomorTagihan" name="invoice_id" value="<?=$invoice_id?>" required readonly>
							</div>
						</div>
						<?php foreach ($invoice as $invoice1): ?>
						<div class="form-group">
							<label class="col-sm-2 control-label">Metode Pembayaran</label>
							<div class="col-sm-10">
								<input type="text"  class="form-control" id="metode_pembayaran" name="metode_pembayaran" value="<?php echo $invoice1->metode_pembayaran ;?>" required disabled>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"></label>
							<div class="col-sm-10">
								<p>Format : Nama Bank - Nomor Rekening - Atas Nama</p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Paket Tarif Pengiriman</label>
							<div class="col-sm-10">
								<input type="text"  class="form-control" id="paket_tarif_pengiriman" name="paket_tarif_pengiriman" value="<?php echo $invoice1->paket_tarif_pengiriman ;?>" required disabled>
							</div>
						</div>
						<?php endforeach ?>
						<h4 class="text-center">Detail Produk</h4>
						<div class="form-group">

							<div class="col-sm-3 text-center">
								<h5>Gambar</h5>       
                            </div>							
							<div class="col-sm-3 text-center">
								<h5>Nama Produk</h5>
							</div>
							<div class="col-sm-3 text-center">
								<h5>Jumlah</h5>
							</div>
							<div class="col-sm-3 text-center">
								<h5>Harga/Satuan</h5>
							</div>
							</div>
						<?php foreach ($produk as $produk1): ?>
							<div class="form-group">
							<div class="col-sm-3 text-center">
								<img  src="<?=base_url('assets/uploads/', '')?><?php echo $produk1->gambar ;?>" style="width: 80px; height: 80px;">        
                            </div>							
							<div class="col-sm-3 text-center">
								<a href="<?=base_url('produk/lihat/', '')?><?php echo $produk1->id_produk ;?>"><?php echo $produk1->nama_produk ;?></a>
							</div>
							<div class="col-sm-3 text-center">
								<h5><?php echo $produk1->jumlah ;?></h5>
							</div>
							<div class="col-sm-3 text-center">
								<h5>Rp. <?php echo $produk1->biaya ;?></h5>
							</div>
							</div>

						<?php endforeach ?>
						<?php foreach ($invoice as $invoice1): ?>
							<div class="form-group">

							<div class="col-sm-9 text-right">
								<h4>Total Belanja + Ongkir : </h4>       
                            </div>							
							<div class="col-sm-3 text-center">
								<h4>Rp. <?php echo $invoice1->total_belanja ;?></h4>
							</div>
							</div>
						<?php endforeach ?>




						<div class="form-group">
							<label for="jumlahTransfer" class="col-sm-2 control-label">Dari atas nama</label>
							<div class="col-sm-10">
								<input type="text" maxlength="130" class="form-control" name="atasnama" value="<?=htmlspecialchars(strtoupper($namapelanggan->nama_depan . ' ' . $namapelanggan->nama_belakang))?>" required>
							</div>
						</div>
						<div class="form-group">
							<label for="jumlahTransfer" class="col-sm-2 control-label">Jumlah transfer</label>
							<div class="col-sm-10">
								<div class="input-group">
									<div class="input-group-addon"><abbr title="Rupiah">Rp</abbr></div>
									<input type="number" min="0" class="form-control" id="jumlahTransfer" name="amount" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="gambarBukti" class="col-sm-2 control-label">Gambar bukti</label>
							<div class="col-sm-10">
								<input type="file" id="gambarBukti" name="gambar" accept="image/jpeg, image/png" required>
								<p class="help-block">Unggah satu foto bukti transfer (format: .jpg, .jpeg, .png)</p>
							</div>
						</div>
						<div class="col-sm-10 col-sm-offset-2">
							<button type="submit" class="btn btn-primary">Konfirmasi pembayaran tagihan</button>
							<button type="reset" class="btn btn-default">Atur ulang kembali form</button>
						</div>
					<?=form_close()?>
					<br>
				</div>
			</div>
			<br>
		</div>