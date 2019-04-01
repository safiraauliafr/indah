<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$col = array ('xs' => 12, 'sm' => 4, 'md' => 3);
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

        <?php
        $this->view('frontend/flashalert');
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h2>Hasil Pencarian: <small><?=htmlspecialchars($katakunci)?></small></h2>
                    <?=form_open('produk/cari', ['method' => 'get'])?>
                        <label class="sr-only" for="katakunci">Cari produk</label>
                        <div class="input-group">
                            <input type="search" name="katakunci" class="form-control" placeholder="Cari tanaman..." maxlength="100" aria-describedby="helpBlock" value="<?=set_value('katakunci');?>" autofocus required>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Cari</button>
                            </span>
                        </div>
                        <span id="helpBlock" class="help-block">Misal: bunga mawar, bromelia</span>
                    <?=form_close()?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (!isset($produk) OR empty($produk))
                    {
                        echo '<p class="lead bg-warning">Maaf, produk yang anda cari tidak ditemukan, coba kembali cari dengan kata kunci lain atau lihat ', anchor('produk', 'semua produk'), '.</p>';
                    }
                    else
                    {
                        echo '<p class="lead">Menampilkan ', count($produk), ' item dari hasil pencarian</p>';
                        foreach($produk as $produk_item) :
                    ?>
                    <div class="col-xs-<?=$col['xs']?> col-sm-<?=$col['sm']?> col-md-<?=$col['md']?>">
                        <div class="thumbnail">
                        <?=img(['src' => PRODUCT_UPLOAD_DIRECTORY . $produk_item->gambar, 'alt' => $produk_item->gambar, 'class' => 'img-responsive'])?>
                            <div class="caption text-center">
                                <p><a href="<?=base_url('produk/tambah_ke_keranjang/' . $produk_item->id_produk)?>" class="btn btn-success" role="button"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a></p>
                                <h3><?=anchor('produk/lihat/' . $produk_item->id_produk, $produk_item->nama)?></h3>
                                <p><?php /*echo rating_to_star($produk_item->rating);*/ ?><br><strong class="text-warning">Rp. <?=number_format($produk_item->harga)?></strong></p>
                            </div>
                        </div>
                    </div>
                    <?php
                        endforeach;
                    }
                    ?>
                </div>
            </div>
        </div>