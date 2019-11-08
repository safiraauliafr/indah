<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Masuk</h1>
            <?php
			echo validation_errors('<div class="alert alert-danger">', '</div>');
			$this->view('frontend/flashalert');
			echo form_open('akun/masuk', ['class' => 'form-horizontal'])
			?>
            <div class="form-group">
                <label for="namaPengguna" class="col-sm-3 control-label">Nama pengguna</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
                        <input type="email" maxlength="64" class="form-control" id="namaPengguna" name="nama"
                            value="<?= set_value('nama') ?>" placeholder="user@email.com" autofocus required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="kataSandi" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
                        <input type="password" maxlength="32" class="form-control" id="kataSandi" name="password"
                            value="<?= set_value('password') ?>" required>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 col-sm-offset-3">
                <button type="submit" class="btn btn-primary">Masuk</button>
                <button type="reset" class="btn btn-default">Atur ulang kembali form</button>
            </div>
            <?= form_close() ?>
            <br>
            <!-- <p>Lupa password? <?= anchor(site_url('#'), 'Klik disini untuk mengatur ulang kata sandi anda') ?>.</p> -->
            <p class="lead">Belum bergabung? Klik disini untuk <?= anchor('akun/daftar', 'registrasi') ?>.</p>
            <br>
        </div>
    </div>
    <br>
</div>