<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

	<div class="container">
		<h1>Daftar Barang dalam Keranjang Belanja Anda</h1>
        <?php
        $this->view('frontend/flashalert');
        ?>
		<div class="row">
            <div class="col-md-12">
                <?php
                if ($this->cart->total_items())
                {
                ?>
                <table id="<?=$datatable?>" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Harga satuan</th>
                            <th>Jumlah</th>
                            <th>Sub-total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 0;
                    foreach($this->cart->contents() as $item)
                    {
                    ?>
                        <tr>
                            <td><?=++$no?></td>
                            <td>
                                <?=img(['src' => PRODUCT_UPLOAD_DIRECTORY . $item['imagepath'], 'alt' => $item['name'], 'width' => 80, 'height' => 80])?>
                                <?=anchor('produk/lihat/' . $item['id'], $item['name'])?>
                            </td>
                            <td class="text-right"><?=number_format($item['price'],0,'.',',')?></td>
                            <td><?=$item['qty']?></td>
                            <td class="text-right"><?=number_format($item['subtotal'],0,'.',',')?></td>
                            <td>
                                <?=anchor('produk/hapus_dari_keranjang/' . $item['rowid'], '<i class="fa fa-remove" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-sm', 'role' => 'button', 'onclick' => 'return promptDelete(' . $no . ')'])?>
                                <?=anchor('produk/tambah_ke_keranjang/' . $item['id'], '<i class="fa fa-plus" aria-hidden="true"></i>', ['class' => 'btn btn-success btn-sm', 'role' => 'button'])?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right">Total</td>
                            <td><strong><?=$this->cart->total_items()?></strong></td>
                            <td class="text-right"><abbr title="Rupiah">Rp</abbr>. <strong><?=$this->cart->format_number($this->cart->total())?></strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="btn-group btn-group-justified btn-group-lg" role="group" aria-label="Kontrol Keranjang">
                    <?=
                    anchor('produk/kosongkan_keranjang', '<i class="fa fa-trash" aria-hidden="true"></i> Kosongkan', ['class' => 'btn btn-danger btn-lg', 'role' => 'button', 'onclick' => 'return promptDeleteAll()']),
                    anchor('produk', '<i class="fa fa-shopping-cart" aria-hidden="true"></i> Lanjut Berbelanja', ['class' => 'btn btn-default btn-lg', 'role' => 'button']),
                    anchor('pemesanan', '<i class="fa fa-check" aria-hidden="true"></i> Periksa', ['class' => 'btn btn-primary btn-lg', 'role' => 'button']);
                    ?>
                </div>
                <script>
                    function promptDelete(id) {
                        return confirm("Apakah anda yakin ingin menghapus barang nomor " + id + " dari keranjang belanja anda?");
                    }
                    function promptDeleteAll() {
                        return confirm("Apakah anda yakin ingin menghapus semua " + <?=$this->cart->total_items()?> + " barang dari keranjang belanja anda?");
                    }
                </script>
                <?php
                }
                else
                {
                ?>
                    <div class="alert alert-warning">Anda belum memiliki barang di keranjang belanja anda, <?=anchor('produk', 'silahkan pilih barang belanjaan terlebih dahulu')?>.</div>
                    <ul class="list-inline">
                        <li><strong>Lihat juga:</strong></li>
                        <li><?=anchor('pelanggan/sejarah_belanja', 'Sejarah Belanja Saya')?></li>
                        <li><?=anchor('pelanggan/konfirmasi_pembayaran', 'Konfirmasi Pembayaran Saya')?></li>
                    </ul>
                <?php
                }
                ?>
            </div>
		</div>
        <br>
	</div>