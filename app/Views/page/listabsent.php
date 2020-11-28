<?= $this->extend('templates/template-dashboard');
$this->section('content'); ?>
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Laporan Absen Saya</h4>
    </div>
</div>

<div class="row justify-content-end pb-3 align-items-center">
    <div class="col-3">
        <p class="card-title">Filter data</p>
    </div>
    <div class="col-9 d-flex justify-content-end">
        <div class="dropdown mr-2">
            <button class="btn btn-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Bulan <i class="link-icon" data-feather="chevron-down" style="width: 20px; height: 20px;"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php $i = 1;
                foreach (bulanindo() as $item) : ?>
                    <?php
                    $dropBulanAbsent = $absent
                        ->where('user_id', session('id'))
                        ->where('bulan', $i)
                        ->where('tahun', $isTahun)
                        ->findAll();
                    if ($dropBulanAbsent) : ?>
                        <a class="dropdown-item" href="<?= base_url('/absent/listabsent') . '/' . $i . '/' . $isTahun ?>"><?= $item ?></a>
                <?php endif;
                    $i++;
                endforeach; ?>
            </div>
        </div>

        <div class="dropdown">
            <button class="btn btn-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Tahun <i class="link-icon" data-feather="chevron-down" style="width: 20px; height: 20px;"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
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
                        <a class="dropdown-item" href="<?= base_url('/absent/listabsent') . '/' . $isBulan . '/' . $year ?>"><?= $year ?></a>
                <?php
                    endfor;
                } ?>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Tabel Absensi</h6>
                <div class="table-responsive">
                <table class="table table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Hari/Tanggal</th>
                                <th>Masuk</th>
                                <th>Pulang</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $max_date = 31;
                            $no = 1;
                            for ($i = 0; $i <= $max_date; $i++) :
                                $date1 = mktime(0, 0, 0, $isBulan, 32 - $i, $isTahun);
                                $day = date("D", $date1);
                                $date = date("Y-m-d", $date1);
                                if ((int)date("m", $date1) != $isBulan) {
                                    continue;
                                } else if ((int)date("d", $date1) > date('d') && (int)date("m", $date1) == date('m')) continue ?>
                                <?php
                                $isAbsent = $absent
                                    ->where([
                                        'user_id' => session('id'),
                                        'tanggal' => date("d", $date1),
                                        'bulan' => date("m", $date1),
                                        'tahun' => date("Y", $date1),
                                    ])
                                    ->first()
                                ?>
                                <tr>
                                    <th><?= $no ?></th>
                                    <td><?= $user['display_name'] ?></td>
                                    <td><?= tgl_full($day, $date) ?></td>
                                    <td><?= $isAbsent ? $isAbsent['jam_masuk'] : '' ?></td>
                                    <td><?= $isAbsent ? $isAbsent['jam_keluar'] : '' ?></td>
                                    <td>
                                        <?= statusAbsent($isAbsent ? $isAbsent['jam_masuk'] : '', $isAbsent ? $isAbsent['jam_keluar'] : '', $user['id_user']) ?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            endfor;
                            ?>
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
                <p class="card-description"><?= tgl_indo(date('Y-m', mktime(0, 0, 0, $isBulan, 2, $isTahun)) . '- ') ?></p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Status</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>1</th>
                                <td>
                                    <div class="badge badge-success">Hadir</div>
                                </td>
                                <td><?= countStatusAbsent('hadir', $isBulan, $isTahun) ?></td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <td>
                                    <div class="badge badge-warning">Terlambat</div>
                                </td>
                                <td><?= countStatusAbsent('terlambat', $isBulan, $isTahun) ?></td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <td>
                                    <div class="badge badge-info">Izin</div>
                                </td>
                                <td><?= countStatusAbsent('izin', $isBulan, $isTahun) ?></td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <td>
                                    <div class="badge badge-danger">Alpha</div>
                                </td>
                                <td><?= countStatusAbsent('alpha', $isBulan, $isTahun) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>