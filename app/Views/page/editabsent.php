<?= $this->extend('templates/template-dashboard');
$this->section('content'); ?>
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Edit Absen</h4>
    </div>
</div>

<?php
$tanggal = $date[2];
$bulan = $date[1];
$tahun = $date[0];
$isAbsent = $absent
    ->where('user_id', $user['id_user'])
    ->where('tanggal', $tanggal)
    ->where('bulan', $bulan)
    ->where('tahun', $tahun)
    ->first();
if ($user['team_id']) {
    $isTeam = $team->find($user['team_id'])['name'];
} else {
    $isTeam = $role->find($user['role_id'])['name'];
}
$isRole = $role->find($user['role_id'])['name'];
?>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Form Edit Absen</h6>
                <p class="card-description">Mengedit Absent untuk user <?= $user['display_name'] ?></p>
                <?= form_open("");
                csrf_field() ?>
                <div class="form-group row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" class="form-control" type="text" value="<?= $user['display_name'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="checkin">Check In</label>
                            <input id="checkin" class="form-control" type="text" value="<?= $isAbsent ?  $isAbsent['jam_masuk'] :  $isAbsent['jam_masuk'] = "00:00:00" ?>" readonly>
                        </div>
                        <?php $isAbsent['jam_masuk'] == "00:00:00" ? $isAbsent['jam_keluar'] = $isAbsent['jam_masuk'] : '' ?>
                        <div class="form-group">
                            <label for="checkout">Check Out</label>
                            <input id="checkout" class="form-control" type="text" value="<?= $isAbsent ?  $isAbsent['jam_keluar'] : $isAbsent['jam_masuk'] = "00:00:00" ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="team">Team</label>
                            <input id="checkout" class="form-control" type="text" value="<?= $isTeam ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input id="checkout" class="form-control" type="text" value="<?= $isRole ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <?php
                                if (jamkeint($isAbsent['jam_masuk']) >= jamkeint($user['jam_masuk'])) {
                                    if (jamkeint($isAbsent['jam_masuk']) == jamkeint($isAbsent['jam_keluar']) && $isAbsent['jam_masuk'] != "00:00:00") {
                                ?>
                                        <option>Hadir</option>
                                        <option>Terlambat</option>
                                        <option>Alpha</option>
                                        <option selected>Izin</option>
                                    <?php
                                    } else if (jamkeint($isAbsent['jam_masuk']) <= jamkeint($user['jam_masuk'])) {
                                    ?>
                                        <option selected>Hadir</option>
                                        <option>Terlambat</option>
                                        <option>Alpha</option>
                                        <option>Izin</option>
                                    <?php
                                    } else if (jamkeint($isAbsent['jam_masuk']) >= jamkeint($user['jam_masuk'])) {
                                    ?>
                                        <option>Hadir</option>
                                        <option selected>Terlambat</option>
                                        <option>Alpha</option>
                                        <option>Izin</option>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <option>Hadir</option>
                                    <option>Terlambat</option>
                                    <option selected>Alpha</option>
                                    <option>Izin</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" name="submit" value="submit"> Update </button>
                <a href="manage-user.html" class="btn btn-light">Batal</a>
                <?php form_close() ?>
            </div>
        </div>
    </div>

</div>

<?php $this->endSection(); ?>