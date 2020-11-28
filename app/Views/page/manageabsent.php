<?= $this->extend('templates/template-dashboard');
$this->section('content'); ?>

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Kelola User Absen</h4>
    </div>
</div>

<div class="row justify-content-end pb-3 align-items-center">
    <div class="col-lg-9 col-md-12 d-flex justify-content-end">
        <div class="dropdown mr-2">
            <button class="btn btn-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Tanggal <i class="link-icon" data-feather="chevron-down" style="width: 20px; height: 20px;"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?= base_url('/absent/manageabsent') . '/' . '0' . '/' . $isBulan . '/' . $isTahun . '/' . $isTeam . '/' . $isUser ?>">Semua</a>
                <?php
                $absent->orderBy('created_at', 'ASC')->first() ? $isYear =  substr($absent->orderBy('created_at', 'ASC')->first()['created_at'], 0, 4) : $isYear = date('Y');
                for ($i = 1; $i <= 31; $i++) :
                    $date1 = mktime(0, 0, 0, $isBulan, $i, $isYear);
                    $day = date("d", $date1);
                    if ((int)date("m", $date1) != (int)date('m', mktime(0, 0, 0, $isBulan))) {
                        break;
                    }
                ?>
                    <a class="dropdown-item" href="<?= base_url('/absent/manageabsent') . '/' . $day . '/' . $isBulan . '/' . $isTahun . '/' . $isTeam . '/' . $isUser ?>"><?= $day ?></a>
                <?php
                endfor ?>
            </div>
        </div>
        <div class="dropdown mr-2">
            <button class="btn btn-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Bulan <i class="link-icon" data-feather="chevron-down" style="width: 20px; height: 20px;"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?= base_url('/absent/manageabsent') . '/' . $isHari . '/' . '0' . '/' . $isTahun . '/' . $isTeam . '/' . $isUser ?>">Semua</a>
                <?php $i = 1;
                foreach (bulanindo() as $item) : ?>
                    <?php
                    $index = $i < 10 ? '0' . $i : $i; ?>
                    <a class="dropdown-item" href="<?= base_url('/absent/manageabsent') . '/' . $isHari . '/' . $index . '/' . $isTahun . '/' . $isTeam . '/' . $isUser ?>"><?= $item ?></a>
                <?php
                    $i++;
                endforeach; ?>
            </div>
        </div>

        <div class="dropdown mr-2">
            <button class="btn btn-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Tahun <i class="link-icon" data-feather="chevron-down" style="width: 20px; height: 20px;"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?= base_url('/absent/manageabsent') . '/' . $isHari . '/' . $isBulan . '/' . '0' . '/' . $isTeam . '/' . $isUser ?>">Semua</a>
                <?php
                if ($isYears = $absent
                    ->orderBy('tahun', 'ASC')
                    ->where('user_id', session('id'))
                    ->findAll()
                ) {
                    $isYear = $isYears[0]['tahun'];
                    for ($i = $isYear; $i <= end($isYears)['tahun']; $i++) :
                        $date1 = mktime(1, 1, 1, 1, 1, $i);
                        $year = date("Y", $date1) ?>
                        <a class="dropdown-item" href="<?= base_url('/absent/manageabsent') . '/' . $isHari . '/' . $isBulan . '/' . $year . '/' . $isTeam . '/' . $isUser ?>"><?= $year ?></a>
                <?php
                    endfor;
                } ?>
            </div>
        </div>

        <?php
        if ($user['team_id'] == null || $user['team_id'] == ' ') { ?>
            <div class="dropdown mr-2">
                <button class="btn btn-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Tim <i class="link-icon" data-feather="chevron-down" style="width: 20px; height: 20px;"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="<?= base_url('/absent/manageabsent') . '/' . $isHari . '/' . $isBulan . '/' . $isTahun . '/' . '0' . '/' . $isUser ?>">Semua</a>
                    <?php foreach ($teams as $item) : ?>
                        <a class="dropdown-item" href="<?= base_url('/absent/manageabsent') . '/' . $isHari . '/' . $isBulan . '/' . $isTahun . '/' . $item['id_team'] . '/' . $isUser ?>"><?= $item['name'] ?></a>
                    <?php endforeach ?>

                </div>
            </div>
        <?php } ?>

        <div class="dropdown">
            <button class="btn btn-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                User <i class="link-icon" data-feather="chevron-down" style="width: 20px; height: 20px;"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="<?= base_url('/absent/manageabsent') . '/' . $isHari . '/' . $isBulan . '/' . $isTahun . '/' . $isTeam . '/' . '0' ?>">Semua</a>
                <?php if ($user['team_id'] == null || $user['team_id'] == ' ') {
                } else {
                    $users = $UserModel->where('team_id', $user['team_id'])->findAll();
                } ?>
                <?php foreach ($users as $item) : ?>
                    <a class="dropdown-item" href="<?= base_url('/absent/manageabsent') . '/' . $isHari . '/' . $isBulan . '/' . $isTahun . '/' . $isTeam . '/' . $item['id_user'] ?>"><?= $item['display_name'] ?></a>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<div class="container">
<div class="row">

    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Table Absensi</h6>
                <div class="table-responsive">
                    <table id="myTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Hari/Tanggal</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Tim</th>
                                <th>Posisi</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?= $allData ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Kehadiran</h6>
                <p class="card-description"></p>
                <div class="table-responsive">
                    <table class="table table-hover" id="myTable-original">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>
                                    <div class="badge badge-success">Hadir</div>
                                </th>
                                <th>
                                    <div class="badge badge-warning">Terlambat</div>
                                </th>
                                <th>
                                    <div class="badge badge-info">Izin</div>
                                </th>
                                <th>
                                    <div class="badge badge-danger">Alpha</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Jumlah</th>
                                <?= $allLabel ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

</div>




<?php $this->endSection(); ?>