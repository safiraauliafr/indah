<?php
defined('BASEPATH') or exit('No direct script access allowed');
$current_page = uri_string();
$current_usergroup = $this->session->userdata('usergroup');
?>

<div>
    <div class="container-fluid headstyle">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php
					$msg = $this->session->flashdata('message');
					if (empty($msg)) {
						echo 'Selamat datang di Butik Indah Busana Muslim';
					} else {
						echo $msg;
					}
					?>
                </div>
                <!-- <div class="col-sm-29 col-sm-offset-3">
                    <a href="<?= base_url(); ?>akun/masuk/">
                        <button type="button" class="btn btn-primary btn-xs pull-right">Masuk</button>
                    </a>
                    <a href="<?= base_url(); ?>akun/daftar/">
                        <button type="button" class="btn btn-default btn-xs pull-right">Registrasi</button>
                    </a> -->
                <!-- <button type="submit" class="btn btn-primary">Masuk</button> -->
                <!-- <button type="reset" class="btn btn-default">Registrasi</button> -->
                <!-- </div> -->


                <div class="col-md-4 text-right">
                    <?php
					if ($current_usergroup) {
						echo anchor(site_url('akun/keluar'), 'Log Out');
					} else {
						echo anchor(site_url('akun/masuk'), 'Masuk'), ' | ', anchor(site_url('akun/daftar'), 'Registrasi');
					}

					?>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Buka/Tutup Navigasi</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= site_url() ?>">Butik Indah Busana Muslim</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li <?php if (stripos($current_page, 'home') !== FALSE) echo ' class="active"'; ?>><a
                            href="<?= site_url() ?>">Home<?php if (stripos($current_page, 'home') !== FALSE) echo ' <span class="sr-only">(saat ini)</span>'; ?></a>
                    </li>
                    <li <?php if (stripos($current_page, 'tentang') !== FALSE) echo ' class="active"'; ?>><a
                            href="#">Tentang<?php if (stripos($current_page, 'tentang') !== FALSE) echo ' <span class="sr-only">(saat ini)</span>'; ?></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                            aria-expanded="false">Produk <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li <?php if (stripos($current_page, 'produk') !== FALSE) echo ' class="active"'; ?>><a
                                    href="<?= site_url('produk') ?>">Semua
                                    Produk<?php if (stripos($current_page, 'produk') !== FALSE) echo ' <span class="sr-only">(saat ini)</span>'; ?></a>
                            </li>
                        </ul>
                    </li>
                    <li <?php if (stripos($current_page, 'contact') !== FALSE) echo ' class="active"'; ?>><a
                            href="#">Contact<?php if (stripos($current_page, 'contact') !== FALSE) echo ' <span class="sr-only">(saat ini)</span>'; ?></a>
                    </li>
                    <li <?php if (stripos($current_page, 'search') !== FALSE) echo ' class="active"'; ?>><a
                            href="<?= site_url('produk/cari') ?>"><i class="fa fa-search"
                                aria-hidden="true"></i><?php if (stripos($current_page, 'search') !== FALSE) echo ' <span class="sr-only">(saat ini)</span>'; ?></a>
                    </li>
                    <li <?php if (stripos($current_page, 'keranjang') !== FALSE) echo ' class="active"'; ?>>
                        <a href="<?= site_url('produk/keranjang') ?>"><i class="fa fa-shopping-basket"
                                aria-hidden="true"></i>
                            <?php
							if ($this->cart->total_items()) {
								?>
                            &nbsp;<span class="badge badge-success"><?= $this->cart->total_items() ?></span>
                            <?php
							} else {
								?>
                            &nbsp;<strong>0</strong>
                            <?php
							}
							?>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                            aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu">
                            <?php
							if ($current_usergroup) {
								?>
                            <li><a href="<?= site_url('pelanggan') ?>">
                                    <h4><i class="fa fa-user" aria-hidden="true"></i>
                                        <?= htmlspecialchars($this->session->userdata('username')) ?></h4>Dashboard
                                </a></li>
                            <li><a href="<?= site_url('akun') ?>">Pengaturan</a></li>
                            <li role="separator" class="divider"></li>
                            <li><?= anchor(site_url('pelanggan/sejarah_belanja'), 'Sejarah Belanja') ?></li>

                            <?php
									if ($current_usergroup == 2) {
										?>
                            <li role="separator" class="divider"></li>
                            <li><?= anchor(site_url('admin/produk'), 'Kelola produk') ?></li>
                            <li><?= anchor(site_url('admin/tagihan'), 'Kelola invoice') ?></li>
                            <li><?= anchor(site_url('#'), 'Kelola pengiriman') ?></li>
                            <li><?= anchor(site_url('#'), 'Kelola pengguna') ?></li>
                            <?php
									}
									?>
                            <li role="separator" class="divider"></li>
                            <?php
							}
							?>
                            <li><?= anchor(site_url('#'), 'Bantuan') ?></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>