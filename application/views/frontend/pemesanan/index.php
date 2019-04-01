<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php
			$this->view('frontend/flashalert');
			?>
			<h1>Daftar Pesanan</h1>
			<table id="<?=$datatable?>" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>ID Tagihan</th>
						<th>Pemesan</th>
						<th>Waktu Pemesanan</th>
						<th>Waktu Tenggat</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
			<?php foreach($tagihan as $tagihan_item) : ?>
				<tr>
					<td><?=$tagihan_item->id_invoice?></td>
					<td><?=$tagihan_item->nama_depan?></td>
					<td><?=date('j-m-Y H:i:s', strtotime($tagihan_item->tanggal))?></td>
					<td><?=date('j-m-Y H:i:s', strtotime($tagihan_item->tenggat))?></td>
					<td><?=$tagihan_item->status?></td>
					<td>
						<?=anchor('admin/tagihan/detail/' . $tagihan_item->id_invoice, '<i class="fa fa-info" aria-hidden="true"></i> Detail', ['class' => 'btn btn-info btn-sm'])?>
                    </td>
				</tr>
			<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	<br>
</div>