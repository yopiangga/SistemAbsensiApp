<?= $this->extend('templates/template-dashboard');
$this->section('content'); ?>
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Detail User</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Form Detail User</h6>
                <p class="card-description"></p>
                <div class="form-group row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input id="name" class="form-control" name="name" type="text" value="<?= $user['display_name'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="team">Tim</label>
                            <input id="team" class="form-control" name="team" type="text" value="<?= $user['team_id'] == null || $user['team_id'] == ' ' ? $role->find($user['role_id'])['name']  : $team->find($user['team_id'])['name']  ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="position">Posisi</label>
                            <input id="position" class="form-control" name="position" type="text" value="<?= $role->find($user['role_id'])['name'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="phone">Jam Masuk</label>
                            <input id="phone" class="form-control" name="phone" type="text" value="<?= $user['jam_masuk'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="phone">Jam Keluar</label>
                            <input id="phone" class="form-control" name="phone" type="text" value="<?= $user['jam_keluar'] ?>" readonly>
                        </div>
                    </div>
                    <div class=" col-md-6">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input id="username" class="form-control" name="username" type="text" value="<?= $user['username'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input id="phone" class="form-control" name="phone" type="text" value="<?= $user['phone'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="phone">Jam Tolerir Masuk</label>
                            <input id="phone" class="form-control" name="phone" type="text" value="<?= $user['tolerir_masuk'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="phone">Jam Tolerir Keluar</label>
                            <input id="phone" class="form-control" name="phone" type="text" value="<?= $user['tolerir_keluar'] ?>" readonly>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('/user/deleteuser/') . "/" . $user['id_user'] ?>" class="btn btn-danger" type="button">Delete User</a>
                <a href="<?= previous_url() ?>" class="btn btn-light">Batal</a>
            </div>
        </div>
    </div>

</div>

<?php $this->endSection(); ?>