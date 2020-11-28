<?= $this->extend('templates/template-dashboard');
$this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Kelola Users</h4>
    </div>
</div>

<a href="create-user.html" class="btn btn-primary mb-3 text-white">Tambah User</a>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Form Tambah User</h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Team</th>
                                <th>Action</th>
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
                                        <td class=" text-capitalize"><?= $user['team_id'] == null ? $role->find($user['role_id'])['name'] :   $role->find($user['team_id'])['name'] ?></td>
                                        <td>
                                            <a href="edit-user.html" class="badge badge-light">Edit</a>
                                            <a href="detail-user.html" class="badge badge-primary">Detail</a>
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