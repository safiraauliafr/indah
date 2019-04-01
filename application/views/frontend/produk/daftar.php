<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$col = array ('xs' => 12, 'sm' => 4, 'md' => 2);
if (isset($cols['xs']))
{
	$col['xs'] = $cols['xs'];
}
if (isset($cols['sm']))
{
	$col['sm'] = $cols['sm'];
}
if (isset($cols['md']))
{
	$col['md'] = $cols['md'];
}
/* 
function rating_to_star($value)
{
	if ($value < 0)
	{
		$value = 0;
	}
	if ($value > 5)
	{
		$value = 5;
	}
	$stars = 0;
	while ($stars < $value)
	{
		echo '<i class="fa fa-star text-success" aria-hidden="true"></i>';
		$stars++;
	}
}
*/
?>

	<div class="container">
		<div class="row">
			<?php
			$this->view('frontend/flashalert');
			?>
			<h1>Daftar Produk</h1>
			<?php if (!isset($produk) OR empty($produk)): ?>
            <p class="lead">Mohon maaf, belum ada daftar produk yang tersedia saat ini, silakan berkunjung kembali nanti!</p>
			<?php
			else:
				foreach($produk as $produk_item) :
			?>
			<div class="col-xs-<?=$col['xs']?> col-sm-<?=$col['sm']?> col-md-<?=$col['md']?>">
				<div class="thumbnail">
				<?=img(['src' => PRODUCT_UPLOAD_DIRECTORY . $produk_item->gambar, 'alt' => $produk_item->gambar, 'width' => 200])?>
					<div class="caption text-center">
						<p><a href="<?=base_url('produk/tambah_ke_keranjang/' . $produk_item->id_produk)?>" class="btn<?=(($produk_item->persediaan > 0) ? ' btn-success' : ' btn-default disabled' )?>" role="button"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a></p>
						<h3><?=anchor('produk/lihat/' . $produk_item->id_produk, $produk_item->nama)?></h3>
						<p><?php /*echo rating_to_star($produk_item->rating);*/ ?><br><strong class="text-warning">Rp. <?=number_format($produk_item->harga)?></strong></p>
					</div>
				</div>
			</div>
			<?php
				endforeach;
			endif;
			?>
		</div>
		<div class="row"><?=$pagination?></div>
		<br>
	</div>