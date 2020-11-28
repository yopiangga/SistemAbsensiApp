<?php $jammasuk = '07.00';
$jampulang = '17.00' ?>
<div class="col-12 col-md-6 col-xl-4 mb-3">
    <div class="card">
        <?php if ($status == 'masuk') { ?>
            <div class="card-header d-flex">
                <div class="col-4">
                    <?= date('H.i') ?>
                </div>
                <div class="col-8 text-right">
                    <?= tgl_indo(date('Y-m-d')) ?>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">Absent Masuk</h5>
                <p class="card-text mb-1">Lakukan absensi masuk sebelum jam <?= $jammasuk ?> </p>
                <a type="button" href="<?= base_url('/absent/check/absent') ?>" class="btn btn-primary" onclick="showSwal('mixin')">Absent Masuk</a>
            </div>
        <?php } else if ($status == 'terlambat-masuk') { ?>
            <div class="card-header d-flex">
                <div class="col-4">
                    <?= date('H.i') ?>
                </div>
                <div class="col-8 text-right">
                    <?= tgl_indo(date('Y-m-d')) ?>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">Absent Masuk Terlambat</h5>
                <p class="card-text mb-1">Lakukan absensi masuk sebelum jam <?= $jammasuk ?> </p>
                <a type="button" href="<?= base_url('/absent/check/absent') ?>" class="btn btn-danger" onclick="showSwal('mixin')">Absent Terlambat</a>
            </div>
        <?php } else if ($status == 'terlambat-pulang') { ?>
            <div class="card-header d-flex">
                <div class="col-4">
                    <?= date('H.i') ?>
                </div>
                <div class="col-8 text-right">
                    <?= tgl_indo(date('Y-m-d')) ?>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">Absent Pulang Terlambat</h5>
                <p class="card-text mb-1">Lakukan absensi pulang sebelum <?= $jampulang ?></p>
                <a type="button" href="<?= base_url('/absent/check/absent') ?>" class="btn btn-danger" onclick="showSwal('mixin')">Absent Terlambat</a>
            </div>
        <?php } else if ($status == 'masuk-terlambat') { ?>
            <div class="card-header d-flex">
                <div class="col-4">
                    <?= date('H.i') ?>
                </div>
                <div class="col-8 text-right">
                    <?= tgl_indo(date('Y-m-d')) ?>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">Absent Masuk Terlambat</h5>
                <p class="card-text mb-1">Anda sudah absent masuk di jam <?= $jam ?></p>
                <button class="btn btn-danger" onclick="showSwal('mixin')">Absent Terlambat</button>
            </div>
        <?php } else if ($status == 'pulang-terlambat') { ?>
            <div class="card-header d-flex">
                <div class="col-4">
                    <?= date('H.i') ?>
                </div>
                <div class="col-8 text-right">
                    <?= tgl_indo(date('Y-m-d')) ?>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">Absent Pulang Terlambat</h5>
                <p class="card-text mb-1">Anda sudah absent masuk di jam <?= $jam ?></p>
                <button class="btn btn-danger" onclick="showSwal('mixin')">Absent Pulang Terlambat</button>
            </div>
        <?php } else if ($status == 'masuk-sukses') { ?>
            <div class="card-header d-flex">
                <div class="col-4">
                    <?= date('H.i') ?>
                </div>
                <div class="col-8 text-right">
                    <?= tgl_indo(date('Y-m-d')) ?>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">Absent Masuk Berhasil</h5>
                <p class="card-text mb-1">Anda sudah absent masuk di jam <?= $jam ?> </p>
                <button class="btn btn-success" onclick="showSwal('mixin')">Absent Berhasil</button>
            </div>
        <?php } else if ($status == 'pulang') { ?>
            <div class="card-header d-flex">
                <div class="col-4">
                    <?= date('H.i') ?>
                </div>
                <div class="col-8 text-right">
                    <?= tgl_indo(date('Y-m-d')) ?>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">Absent Pulang</h5>
                <p class="card-text mb-1">Lakukan absensi pulang sebelum jam 16.00</p>
                <a type="button" href="<?= base_url('/absent/check/absent') ?>" class="btn btn-primary" onclick="showSwal('mixin')">Absent Pulang</a>
            </div>
        <?php } else if ($status == 'tidak-tersedia-pulang') { ?>
            <div class="card-header d-flex">
                <div class="col-4">
                    <?= date('H.i') ?>
                </div>
                <div class="col-8 text-right">
                    <?= tgl_indo(date('Y-m-d')) ?>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">Absent Pulang Belum Tersedia</h5>
                <p class="card-text mb-1">Tunggu sampai jam pulang berlangsung</p>
                <button class="btn btn-secondary" onclick="showSwal('mixin')">Absent Pulang Belum tersedia</button>
            </div>
        <?php } else if ($status == 'tidak-tersedia') { ?>
            <div class="card-header d-flex">
                <div class="col-4">
                    <?= date('H.i') ?>
                </div>
                <div class="col-8 text-right">
                    <?= tgl_indo(date('Y-m-d')) ?>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">Absent Belum Tersedia</h5>
                <p class="card-text mb-1">Tunggu sampai jam oprasional berlangsung</p>
                <button class="btn btn-secondary" onclick="showSwal('mixin')">Absent Belum tersedia</button>
            </div>
        <?php } ?>
    </div>
</div>