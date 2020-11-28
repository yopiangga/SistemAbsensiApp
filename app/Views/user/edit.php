<?= $this->extend('templates/template-dashboard');
$this->section('content'); ?>
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Edit User</h4>
    </div>
</div>
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Form Edit User</h6>
                <?= form_open("");
                csrf_field() ?>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input id="name" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : "" ?>" name="name" type="text" autofocus value="<?= (old('name')) ? old('name') : $user['display_name']  ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('name') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="team">Tim</label>
                    <select class="form-control <?= ($validation->hasError('team')) ? 'is-invalid' : "" ?>" name="team">
                        <?php foreach ($teams as $team) : ?>
                            <option value="<?= $team['id_team'] ?>" <?= $team['id_team'] == $user['team_id'] ? 'selected' : '' ?>> <?= $team['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('team') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="position">Posisi</label>
                    <select class="form-control" name="role">
                        <?php foreach ($roles as $role) : ?>
                            <option value="<?= $role['id_role'] ?>" <?= $role['id_role'] == $user['role_id'] ? 'selected' : '' ?>> <?= $role['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jam Masuk:</label>
                    <input class="form-control time-work <?= ($validation->hasError('jam_masuk')) ? 'is-invalid' : "" ?>" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="HH:MM:ss" name="jam_masuk" value="<?= (old('jam_masuk')) ? old('jam_masuk') : $user['jam_masuk']  ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('jam_masuk') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Jam Keluar:</label>
                    <input class="form-control time-work <?= ($validation->hasError('jam_keluar')) ? 'is-invalid' : "" ?>" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="HH:MM:ss" name="jam_keluar" value="<?= (old('jam_keluar')) ? old('jam_keluar') : $user['jam_keluar']  ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('jam_keluar') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Toleransi Jam Masuk:</label>
                    <input class="form-control time-work <?= ($validation->hasError('tolerir_masuk')) ? 'is-invalid' : "" ?>" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="HH:MM:ss" name="tolerir_masuk" value="<?= (old('tolerir_masuk')) ? old('tolerir_masuk') : $user['tolerir_masuk']  ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('tolerir_masuk') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Toleransi Jam Keluar:</label>
                    <input class="form-control time-work <?= ($validation->hasError('tolerir_keluar')) ? 'is-invalid' : "" ?>" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="HH:MM:ss" name="tolerir_keluar" value="<?= (old('tolerir_keluar')) ? old('tolerir_keluar') : $user['tolerir_keluar']  ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('tolerir_keluar') ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2" name="submit" value="Update">Update</button>
                <a href="<?= base_url('/user') ?>" class="btn btn-light">Batal</a>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>