<?= $this->extend('templates/template-dashboard');
$this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Tambah User</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Form Tambah User</h6>
                <?= form_open("");
                csrf_field() ?>
                <div class="form-group row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input id="name" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : "" ?>" name="name" type="text" autofocus value="<?= old('name') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('name') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="team">Tim</label>
                            <select class="form-control <?= ($validation->hasError('team')) ? 'is-invalid' : "" ?>" id="team" name="team">
                                <?php foreach ($teams as $team) : ?>
                                    <option value="<?= $team['id_team'] ?>"> <?= $team['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('team') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="position">Posisi</label>
                            <select class="form-control" id="position" name="role">
                                <?php foreach ($roles as $role) : ?>
                                    <option value="<?= $role['id_role'] ?>"> <?= $role['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jam Masuk:</label>
                            <input class="form-control time-work <?= ($validation->hasError('jam_masuk')) ? 'is-invalid' : "" ?>" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="HH:MM:ss" name="jam_masuk" value="<?= old('jam_masuk') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jam_masuk') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jam Keluar:</label>
                            <input class="form-control time-work <?= ($validation->hasError('jam_keluar')) ? 'is-invalid' : "" ?>" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="HH:MM:ss" name="jam_keluar" value="<?= old('jam_keluar') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jam_keluar') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input id="phone" class="form-control <?= ($validation->hasError('phone')) ? 'is-invalid' : "" ?>" name="phone" type="text" autofocus value="<?= old('phone') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('phone') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input id="username" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : "" ?>" name="username" type="text" autofocus value="<?= old('username') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('username') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : "" ?>" name="password" type="password" autofocus value="<?= old('password') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('password') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Toleransi Jam Masuk:</label>
                            <input class="form-control time-work <?= ($validation->hasError('tolerir_masuk')) ? 'is-invalid' : "" ?>" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="HH:MM:ss" name="tolerir_masuk" value="<?= old('tolerir_masuk') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tolerir_masuk') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Toleransi Jam Keluar:</label>
                            <input class="form-control time-work <?= ($validation->hasError('tolerir_keluar')) ? 'is-invalid' : "" ?>" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="HH:MM:ss" name="tolerir_keluar" value="<?= old('tolerir_keluar') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tolerir_keluar') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <input class="btn btn-primary" type="submit" name="submit" value="Tambah">
                <a href="<?= previous_url() ?>" class="btn btn-light">Batal</a>
                <?= form_close() ?>
            </div>
        </div>
    </div>

</div>

<?php $this->endSection(); ?>