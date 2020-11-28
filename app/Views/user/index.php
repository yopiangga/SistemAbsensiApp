<?= $this->extend('templates/template-dashboard');
$this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Kelola Users</h4>
    </div>
</div>

<a href="<?= base_url('/user/adduser') ?>" class="btn btn-primary mb-3 text-white">Tambah User</a>
<?php if (session()->getFlashdata('message')) : ?>
    <div class="alert alert-success" role="alert">
        <strong> <?= session()->getFlashdata('message') ?> </strong>
    </div>
<?php endif ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Posisi</th>
                                <th>Tim</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            if ($users) :
                                foreach ($users as $user) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $user['display_name'] ?></td>
                                        <td class=" text-capitalize"><?= $role->find($user['role_id'])['name'] ?></td>
                                        <td class=" text-capitalize"><?= $user['team_id'] == ' ' || $user['team_id'] == null ? $role->find($user['role_id'])['name'] :   $team->find($user['team_id'])['name'] ?></td>
                                        <td>
                                            <a href="<?= base_url('/user/edituser') . "/" . $user['id_user'] ?>" class="badge badge-light">Edit</a>
                                            <a href="<?= base_url('/user/detailuser') . "/" . $user['id_user'] ?>" class="badge badge-primary">Detail</a>
                                        </td>
                                    </tr>

                            <?php $i++;
                                endforeach;
                            endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>