<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Daftar Barang Pesanan pada Tagihan #<?=$tagihan->id_invoice?></h1>
			<table id="<?=$datatable?>" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>ID Produk</th>
						<th>Nama Produk</th>
						<th>Jumlah</th>
						<th>Harga</th>
						<th>Subtotal</th>
					</tr>
				</thead>
				<tbody>
            <?php
			$total = 0;
			$totalbarang = 0;
			$totaljenis = 0;
            foreach($pemesanan as $barang) :
                $subtotal = $barang->jumlah * $barang->biaya;
				$total += $subtotal;
				$totalbarang += $barang->jumlah;
				$totaljenis++;
            ?>
				<tr>
					<td><?=$barang->id_pemesanan?></td>
					<td><?=anchor_popup('produk/lihat/' . $barang->id_produk, $barang->nama_produk)?></td>
					<td><?=$barang->jumlah?></td>
					<td><?=number_format($barang->biaya,0,'.',',')?></td>
					<td><?=number_format($subtotal,0,'.',',')?></td>
				</tr>
			<?php endforeach; ?>
				</tbody>
                <tfoot>
					<td class="text-right">Total</td>
					<td><?=$totaljenis?> jenis</td>
					<td><?=$totalbarang?> unit</td>
                    <td colspan="2" class="text-right"><abbr title="Rupiah">Rp</abbr>. <strong><?=number_format($total,0,'.',',')?></strong></td>
                </tfoot>
			</table>
		</div>
	</div>
	<div class="row">
		<?php
		if (isset($pemesan) && !empty($pemesan))
		{
		?>
		<div class="col-md-6">
			<h3>Detail Pemesanan</h3>
			<dl class="dl-horizontal">
				<dt>Status</dt>
				<dd><?=$tagihan->status?></dd>
				<dt>Waktu pemesanan</dt>
				<dd><?=date('j F Y - H:i:s', strtotime($tagihan->tanggal))?></dd>
				<dt>Tenggat hingga</dt>
				<dd><?=date('j F Y - H:i:s', strtotime($tagihan->tenggat))?></dd>
			</dl>
			<address>
			<h3>Detail Pemesan</h3>
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
				$kodepos = '<i>' . $pemesan->kode_pos.'</i>';
			}
			echo $kodepos;
			?></p>
			<abbr title="Telepon"><i class="fa fa-phone" aria-hidden="true"></i></abbr> <?=$pemesan->nomor_telepon?><br>
			<abbr title="Surel"><i class="fa fa-envelope" aria-hidden="true"></i></abbr> <a href="mailto:<?=$pemesan->nama?>"><?=$pemesan->nama?></a>
			</address>
		</div>
		<?php
		}
		if (!empty($tagihan->bukti_pembayaran))
		{
		?>
		<div class="col-md-6">
			<h3>Bukti Transfer</h3>
			<?=img(['src' => PAYMENT_UPLOAD_DIRECTORY .$tagihan->bukti_pembayaran, 'alt' => 'gambar bukti pembayaran', 'width' => 400])?>
		</div>
		<?php
		}
		?>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="btn-group" role="group" aria-label="Kontrol Pemesanan">
				<?php
				if ($tagihan->status == 'canceled' || $tagihan->status == 'expired')
				{
					if (time() > strtotime($tagihan->tenggat))
					{
						echo anchor('admin/tagihan/hapus/' . $tagihan->id_invoice, '<i class="fa fa-trash" aria-hidden="true"></i> Buang', ['class' => 'btn btn-danger', 'role' => 'button']);
					}
					else
					{
						echo anchor('admin/tagihan/hapus/' . $tagihan->id_invoice, '<i class="fa fa-trash" aria-hidden="true"></i> Buang', ['class' => 'btn btn-danger', 'role' => 'button', 'disabled' => 'disabled', 'title' => 'Hanya dapat dibuang setelah masa tenggat habis']);
					}
				}
				else if ($tagihan->status == 'unpaid')
				{
					echo anchor('admin/tagihan/batal' . $tagihan->id_invoice, '<i class="fa fa-times" aria-hidden="true"></i> Batalkan', ['class' => 'btn btn-danger', 'role' => 'button']);
				}
				else if ($tagihan->status == 'paid')
				{
					echo
						anchor('admin/tagihan/batal/' . $tagihan->id_invoice, '<i class="fa fa-times" aria-hidden="true"></i> Tolak', ['class' => 'btn btn-danger', 'role' => 'button']),
						anchor('admin/tagihan/konfirmasi/' . $tagihan->id_invoice, '<i class="fa fa-check" aria-hidden="true"></i> Terima & Konfirmasi', ['class' => 'btn btn-primary', 'role' => 'button']);
				}
				else if ($tagihan->status == 'confirmed')
				{
					echo anchor('admin/tagihan/konfirmasi/' . $tagihan->id_invoice, '<i class="fa fa-truck" aria-hidden="true"></i> Pengiriman', ['class' => 'btn btn-primary', 'role' => 'button']);
				}
				?>
			</div>
		</div>
	</div>
	<br>
</div>