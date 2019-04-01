<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
            <div class="col-md-3 text-center">

                </div>
            </div>
            <div class="col-md-9">
                <?php foreach($produk as $produk_item) : ?>
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <div class="thumbnail">
                    <?=img(['src' => PRODUCT_UPLOAD_DIRECTORY . $produk_item->gambar, 'alt' => $produk_item->gambar, 'width' => 200])?>
                        <div class="caption text-center">
                            <a href="<?=base_url('produk/tambah_ke_keranjang/' . $produk_item->id_produk)?>" class="btn<?=(($produk_item->persediaan > 0) ? ' btn-success' : ' btn-default disabled' )?>"  role="button"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
                            <h3><?=anchor('produk/lihat/' . $produk_item->id_produk, $produk_item->nama)?></h3>
                            <p><?php /*echo rating_to_star($produk_item->rating);*/ ?></p>
                            <p class="text-warning">
                            <?php
                            if ($produk_item->persediaan > 0)
                            {
                            ?>
                                <strong>Rp. <?=number_format($produk_item->harga)?></strong>
                            <?php
                            }
                            else
                            {
                            ?>
                                <span class="label label-default">Persediaan Habis</span>
                            <?php
                            }
                            ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <br>
    </div>