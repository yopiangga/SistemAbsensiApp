<?php
$user = $UserModel->find(session('id'));
$absent = $AbsentModel
    ->where('user_id', session('id'))
    ->where('tanggal', date('d'))
    ->where('bulan', date('m'))
    ->where('tahun', date('Y'))
    ->first();
$urlAbsent = base_url('/absent/turn');
if (jamkeint(date('H:i:s')) > jamkeint($user['jam_masuk']) - jamkeint($user['tolerir_masuk']) && jamkeint(date('H:i:s')) < jamkeint($user['jam_keluar']) + jamkeint($user['tolerir_keluar'])) {
    if (jamkeint(date('H:i:s')) < jamkeint($user['jam_masuk'])) {
        $btnMasuk = '<a href="' . $urlAbsent . '" role="button" class="btn btn-primary">Absen Masuk</a>';
    } else if (jamkeint(date('H:i:s')) < jamkeint($user['jam_masuk']) + jamkeint($user['tolerir_masuk'])) {
        $btnMasuk = '<a href="' . $urlAbsent . '" role="button" class="btn btn-warning">Absen Terlmbat</a>';
    } else {
        $btnMasuk = '<button class="btn btn-secondary">Absen tidak ada</button>';
    }
    if (jamkeint(date('H:i:s')) > jamkeint($user['jam_keluar']) - jamkeint($user['tolerir_keluar'])) {
        if (jamkeint(date('H:i:s')) < jamkeint($user['jam_keluar'])) {
            $btnKeluar = '<a href="' . $urlAbsent . '" role="button" class="btn btn-primary">Absen keluar</a>';
        } else if (jamkeint(date('H:i:s')) < jamkeint($user['jam_keluar']) + jamkeint($user['tolerir_keluar'])) {
            $btnKeluar = '<a href="' . $urlAbsent . '" role="button" class="btn btn-warning">Absen Terlmbat</a>';
        }
    } else {
        $btnKeluar = '<button class="btn btn-secondary">Absen tidak ada</button>';
    }
} else {
    $btnMasuk = '<button class="btn btn-secondary">Absen tidak ada</button>';
    $btnKeluar = '<button class="btn btn-secondary">Absen tidak ada</button>';
}
if ($absent) {
    if ($absent['jam_masuk']) {
        $btnMasuk = '<button class="btn btn-success">Absen Berhasil Masuk</button>';
    }
    if ($absent['jam_keluar'] != '00:00:00') {
        $btnKeluar = '<button class="btn btn-success">Absen Berhasil Pulang</button>';
    }
}
?>
<div class="row">
    <div class="col-12 col-md-6 col-xl-4 mb-3">
        <div class="card">
            <div class="card-header d-flex">
                <div class="col-4">
                    <?= date('H:i:s') ?>
                </div>
                <div class="col-8 text-right">
                    <?= tgl_indo(date('Y-m-d')) ?>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">Absen Masuk</h5>
                <p class="card-text mb-1">Lakukan absensi masuk sebelum jam <?= $user['jam_masuk'] ?></p>
                <?= $btnMasuk ?>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-4">
        <div class="card">
            <div class="card-header d-flex">
                <div class="col-4">
                    <?= date('H:i:s') ?>
                </div>
                <div class="col-8 text-right">
                    <?= tgl_indo(date('Y-m-d')) ?>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">Absen Pulang</h5>
                <p class="card-text mb-1">Lakukan absensi pulang setelah jam <?= $user['jam_keluar'] ?></p>
                <?= $btnKeluar ?>
            </div>
        </div>
    </div>
</div>