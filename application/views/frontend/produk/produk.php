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
    while ($stars < 5)
    {
        echo '<i class="fa fa-star-empty aria-hidden="true"></i>';
        $stars++;
    }
}
*/
?>

        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <?=img(['src' => PRODUCT_UPLOAD_DIRECTORY . $produk_item->gambar, 'alt' => $produk_item->gambar, 'width' => 400])?>
                </div>
                <div class="col-md-4">
                    <h3><?=htmlspecialchars($produk_item->nama)?></h3>
                    <p><?php /*echo rating_to_star($produk_item->rating);*/ ?></p>
                    <p class="lead text-warning">Rp. <strong><?=number_format($produk_item->harga)?></strong></p>
                    <br>
                    <p><?=htmlspecialchars($produk_item->deskripsi)?></p>
                    <br>
                    <?php
                    if ($produk_item->persediaan > 0)
                    {
                        echo form_open('produk/tambah_ke_keranjang', ['method' => 'get', 'class' => 'form-horizontal'], ['id' => $produk_item->id_produk]);
                    ?>
                        <label for="jumlah">Jumlah: </label>
                        <input class="form-control" type="number" name="jumlah" aria-describedby="helpBlock" min="1" max="<?=(int)$produk_item->persediaan?>" autofocus required>
                        <span id="helpBlock" class="help-block">Tersedia: <?=$produk_item->persediaan?></span>
                        <button type="submit" class="btn btn-success btn-lg" role="button"><i class="fa fa-cart-plus" aria-hidden="true"></i> Tambah ke keranjang belanja</button>
                    <?php
                        echo form_close();
                    }
                    else
                    {
                    ?>
                        <p class="bg-danger lead">Maaf, produk tidak tersedia saat ini, silakan periksa kembali nanti.</p>
                    <?php
                    }
                    ?>
                    <br>
                </div>
            </div>
            <br>
        </div>