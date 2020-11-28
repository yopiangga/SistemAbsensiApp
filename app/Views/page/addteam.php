<?= $this->extend('templates/template-dashboard');
$this->section('content'); ?>
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Tambah Tim</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-6 grid-margin">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Form Tambah Tim</h6>
                <p class="card-description"></p>
                <?= form_open("");
                csrf_field() ?>
                <div class="form-group row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Name Tim</label>
                            <input id="name" class="form-control" name="name" type="text">
                        </div>

                    </div>

                </div>
                <input class="btn btn-primary" type="submit" value="Tambah">
                <?php form_close() ?>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>