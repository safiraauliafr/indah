<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Halaman Pencarian</h2>
                    <?php
                    echo validation_errors('<div class="alert alert-danger">', '</div>');
                    $this->view('frontend/flashalert');
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <?=form_open('produk/cari', ['method' => 'get'])?>
                        <label class="sr-only" for="katakunci">Cari produk</label>
                        <div class="input-group">
                            <input type="search" name="katakunci" class="form-control" placeholder="Cari tanaman..." maxlength="100" aria-describedby="helpBlock" autofocus required>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Cari</button>
                            </span>
                        </div>
                        <span id="helpBlock" class="help-block">Misal: bunga mawar, bromelia</span>
                    <?=form_close()?>
                </div>
            </div>
            <br>
        </div>