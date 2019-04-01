<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Daftar Produk</h1>
			<table id="<?=$datatable?>" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Nama</th>
						<th>Harga (Rp)</th>
						<th>Deskripsi</th>
						<th>Persediaan</th>
						<th><?=anchor('admin/produk/tambah', '<i class="fa fa-plus" aria-hidden="true"></i> Tambah', ['class' => 'btn btn-primary btn-sm'])?></th>
					</tr>
				</thead>
				<tbody>
			<?php foreach($produk as $produk_item) : ?>
				<tr>
					<td><?=$produk_item->id_produk?></td>
					<td><?=anchor_popup('produk/lihat/' . $produk_item->id_produk, $produk_item->nama)?></td>
					<td><?=number_format($produk_item->harga,0,'.',',')?></td>
					<td><?=character_limiter($produk_item->deskripsi)?></td>
					<td><?=$produk_item->persediaan?></td>
					<td>
						<?=anchor('admin/produk/edit/' . $produk_item->id_produk, '<i class="fa fa-cog" aria-hidden="true"></i> Edit', ['class' => 'btn btn-info btn-sm'])?>
						<?=anchor('admin/produk/hapus/' . $produk_item->id_produk, '<i class="fa fa-trash" aria-hidden="true"></i> Hapus',['class' => 'btn btn-danger btn-sm', 'onclick' => 'return promptDelete(' . $produk_item->id_produk . ')'])?>
					</td>
				</tr>
			<?php endforeach; ?>
				</tbody>
			</table>
			<script>
				function promptDelete(id) {
					return confirm("Apakah anda yakin ingin menghapus produk #" + id + "?");
				}
				</script>
		</div>
	</div>
	<br>
</div>