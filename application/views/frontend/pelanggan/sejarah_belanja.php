<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Sejarah Belanja</h1>
            <?php
			$this->view('frontend/flashalert');
            if (!isset($history) OR empty($history))
            {
                echo 'Belum ada daftar produk yang anda pernah beli, ', anchor('produk', 'Belanja sekarang!');
			}
			else
			{
            ?>
			<table id="<?=$datatable?>" class="table table-striped table-bordered table-hover datatable">
				<thead>
					<tr>
						<th>ID Tagihan</th>
						<th>Metode Pembayaran</th>
						<th>Waktu Pemesanan</th>
						<th>Waktu Tenggat</th>
                        <th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
			<?php
			$now = time();
			foreach($history as $tagihan_item) :
			?>
				<tr <?php
					if ($tagihan_item->status == 'paid')
					{
						echo 'class="success"';
					}
					else if ($tagihan_item->status == 'confirmed')
					{
						echo 'class="info"';
					}
					else if ($now > strtotime($tagihan_item->tenggat))
					{
						echo 'class="danger"';
					}
					else if ($tagihan_item->status == 'unpaid')
					{
						echo 'class="warning"';
					}
					?>>
					<td><?=$tagihan_item->id_invoice?></td>
					<td><?=$tagihan_item->metode_pembayaran?></td>
					<td><?=$tagihan_item->tanggal?></td>
					<td><?=$tagihan_item->tenggat?></td>
					<td><?=htmlspecialchars($tagihan_item->status)?></td>
					<td>
					<?php
						if ($tagihan_item->status == 'unpaid')
						{
							echo anchor('pelanggan/konfirmasi_pembayaran/' . $tagihan_item->id_invoice, 'Konfirmasi Pembayaran', ['class'=>'btn btn-primary btn-xs']), ' ';
							echo anchor('pelanggan/batal_belanja/' . $tagihan_item->id_invoice, 'Batalkan', ['class'=>'btn btn-danger btn-xs']);
						}elseif ($tagihan_item->status == 'confirmed') {
							echo form_open('https://cekresi.com', ['method' => 'get', 'class' => 'form-horizontal', 'target' => '_blank']);
							//echo "Nomor Resi : $tagihan_item->nomor_resi";	
							echo '<div class="form-group">
                              <div class="col-sm-12">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="inputCekResi" name="noresi" placeholder="Masukkan nomor resi..." value="'.$tagihan_item->nomor_resi.'" readonly>
                                    <span class="input-group-btn"><button type="submit" class="btn btn-warning"><u class="fa fa-external-link" aria-hidden="true"></u></button></span>
                                </div>
                            </div>
                        </div>';
                        echo form_close();
						
						}
					?>
					</td>
				</tr>
			<?php
				endforeach;
			}
			?>
				</tbody>
			</table>
		</div>
	</div>
	<br>
</div>