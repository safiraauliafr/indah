<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$namadepan = ucfirst($namapelanggan->nama_depan);
$namabelakang = ucfirst($namapelanggan->nama_belakang);
?>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>Selamat Datang, <?=htmlspecialchars($namadepan)?> <?=htmlspecialchars($namabelakang)?></h2>
            <?php $this->view('frontend/flashalert'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading text-center"><h3>Main Menu</h3></div>
                <div>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><?=anchor('pelanggan', '<h4><i class="fa fa-dashboard" aria-hidden="true"></i> Dashboard</h4>')?></li>
                        <li><?=anchor('produk/keranjang', '<h4><i class="fa fa-shopping-cart" aria-hidden="true"></i> Pembelian</h4>')?></li>
                        <li><?=anchor('pelanggan/konfirmasi_pembayaran', '<h4><i class="fa fa-credit-card" aria-hidden="true"></i> Pembayaran</h4>')?></li>
                        <li><?=anchor('pelanggan/sejarah_belanja', '<h4><i class="fa fa-list-alt" aria-hidden="true"></i> Pemesanan</h4>')?></li>
                        <li><?=anchor('#', '<h4><i class="fa fa-volume-control-phone" aria-hidden="true"></i> Hubungi Kami</h4>')?></li>
                        <li><?=anchor('akun/keluar', '<h4><i class="fa fa-sign-out" aria-hidden="true"></i> Log Out</h4>')?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li role="presentation" class="active"><a href="#belumbayar" aria-controls="belumbayar" role="tab" data-toggle="tab">Belum Bayar</a></li>
                <li role="presentation"><a href="#telahbayar" aria-controls="telahbayar" role="tab" data-toggle="tab">Telah Bayar</a></li>
                <li role="presentation"><a href="#dikemas" aria-controls="dikemas" role="tab" data-toggle="tab">Dikemas</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="belumbayar">
                    <?php
                    if (empty($tagihan))
                    {
                        echo 'Tidak ada produk yang belum dibayar saat ini';
                    }
                    else
                    {
                        $now = time();
                        foreach ($tagihan as $tagihan_item): ?>
                    <div class="row<?=(($now > strtotime($tagihan_item->tenggat)) ? ' bg-warning' : '')?>">
                        <div class="col-md-4"><?=$tagihan_item->id_invoice?></div>
                        <div class="col-md-3"><?=$tagihan_item->tanggal?><br><?=$tagihan_item->tenggat?></div>
                        <div class="col-md-5">
                            <?=anchor('pelanggan/konfirmasi_pembayaran/' . $tagihan_item->id_invoice, 'Konfirmasi Pembayaran', ['class'=>'btn btn-primary btn-xs']), ' ',
							anchor('pelanggan/batal_belanja/' . $tagihan_item->id_invoice, 'Batalkan', ['class'=>'btn btn-danger btn-xs']);?>
                        </div>
                    </div>
                    <?php
                        endforeach;
                    }
                    ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="telahbayar">Tidak ada barang di sini!</div>
                <div role="tabpanel" class="tab-pane" id="dikemas">Tidak ada barang disini!</div>
            </div>
        </div>
    </div>
</div>