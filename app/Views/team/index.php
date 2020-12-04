<?= $this->extend('templates/template-dashboard');
$this->section('content'); ?>
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Tambah Tim</h4>
    </div>
</div>
<?php
if ($user['team_id'] == null || $user['team_id'] == ' ') { ?>
    <a href="<?= base_url('team/createteam') ?>" class="btn btn-primary mb-3 text-white">Tambah Tim</a>
<?php }
if (session()->getFlashdata('message')) : ?>
    <div class="alert alert-success" role="alert">
        <strong> <?= session()->getFlashdata('message') ?> </strong>
    </div>
<?php endif ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Tim</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            if ($teams) :
                                foreach ($teams as $team) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $team['name'] ?></td>
                                        <td><?= $team['active'] == 1 ? "Active" : "Non Active" ?></td>
                                        <td>
                                            <a href="<?= base_url('/team/editteam') . "/" . $team['id_team'] ?>" class="badge badge-primary">Edit</a>
                                            <a href="<?= base_url('/team/deleteteam') . "/" . $team['id_team'] ?>" class="badge badge-danger">Delete</a>
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