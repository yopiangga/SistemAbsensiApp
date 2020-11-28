<?php
$absent
    ->orderBy('tahun', 'ASC')
    ->first() ? $tabletahunstart = $absent
        ->orderBy('tahun', 'ASC')
        ->first()['tahun'] : $tabletahunstart = date('Y');
$absent
    ->orderBy('tahun', 'DESC')
    ->first() ? $tabletahunend = $absent
        ->orderBy('tahun', 'DESC')
        ->first()['tahun'] : $tabletahunend = date('Y');
$isTahun ? $startYear = $isTahun : $startYear = $tabletahunstart;
$isTahun ? $endYear = $isTahun : $endYear = $tabletahunend;
$isBulan ? $startBulan = $isBulan : $startBulan =  1;
$isBulan ? $endBulan = $isBulan : $endBulan = 12;
$isTanggal ? $startTanggal = $isTanggal : $startTanggal = 1;
$isTanggal ? $endTanggal = $isTanggal : $endTanggal = 31;
if ($isUser) {
    $dUser = $user->find($isUser);
    if ($dUser['team_id']) {
        $teams = $team->where('id_team', $dUser['team_id'])->findAll();
    } else {
        $teams = [];
    }
} else {
    $isTeam ? $teams = $team->where('id_team', $isTeam)->findAll() : $teams = $team->findAll();
}
$dataUser = $user->find(session('id'));
if ($dataUser['team_id'] == null || $dataUser['team_id'] == ' ') {
} else {
    $teams = $team->where('id_team', $dataUser['team_id'])->findAll();
    $isTeam = $dataUser['team_id'];
}

$no = 1;
for ($i = $startYear; $i <= $endYear; $i++) :
    for ($j = $startBulan; $j <= $endBulan; $j++) :
        for ($k = $startTanggal; $k <= $endTanggal; $k++) :
            $date1 = mktime(1, 1, 1, $j, $k, $i);
            $Day = date("D", $date1);
            $day = date("d", $date1);
            $date = date("Y-m-d", $date1);
            if (date("m", $date1) > $endBulan) continue;
            if ($teams) {
                foreach ($teams as $eachteam) {
                    if ($isUser) {
                        $users = $user
                            ->where('team_id', $eachteam['id_team'])
                            ->where('id_user', $isUser)
                            ->findAll();
                    } else {
                        $users = $user->where('team_id', $eachteam['id_team'])->findAll();
                    }
                    foreach ($users as $eachuser) {
                        $displayuser = $eachuser['display_name'];
                        $teamUser = $eachteam['name'];
                        if ($absents = $absent
                            ->where('user_id', $eachuser['id_user'])
                            ->where('tanggal', $k)
                            ->where('bulan', $j)
                            ->where('tahun', $i)
                            ->findAll()
                        ) {
                            foreach ($absents as $item) { ?>

                                <?php $itemUser = $user->find($item['user_id']) ?>
                                <?php $itemUser['team_id'] == null || $itemUser['team_id'] == ' ' ?  $nameTeam = $role->find($itemUser['role_id'])['name'] : $nameTeam = $team->find($itemUser['team_id'])['name']  ?>
                                <tr>
                                    <th><?= $no ?></th>
                                    <td><?= $itemUser['display_name']  ?></td>
                                    <td><?= tgl_full($Day, $date) ?></td>
                                    <td><?= $item['jam_masuk'] ?></td>
                                    <td><?= $item['jam_keluar'] ?></td>
                                    <td><?= $nameTeam ?></td>
                                    <td><?= $role->find($itemUser['role_id'])['name'] ?></td>
                                    <td>
                                        <?= statusAbsent($item['jam_masuk'], $item['jam_keluar'], $eachuser['id_user']) ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('/absent/editabsent' . '/' . $eachuser['id_user'] . '/' . $date) ?>" class="badge badge-primary">Edit</a>

                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                        } else { ?>
                            <tr>
                                <th><?= $no ?></th>
                                <td><?= $displayuser ?></td>
                                <td><?= tgl_full($Day, $date) ?></td>
                                <td></td>
                                <td></td>
                                <td><?= $eachuser['team_id'] == ' ' || $eachuser['team_id'] == null ? $role->find($eachuser['role_id'])['name'] : $eachteam['name'] ?></td>
                                <td><?= $role->find($eachuser['role_id'])['name'] ?></td>
                                <td>
                                    <?= statusAbsent('', '', $eachuser['id_user']) ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('/absent/editabsent' . '/' . $eachuser['id_user'] . '/' . $date) ?>" class="badge badge-primary">Edit</a>

                                </td>
                            </tr>
                            <?php
                            $no++;
                        }
                    }
                }
                if (!$isTeam && !$isUser) {
                    $users = $user->where('team_id', ' ')->findAll();
                    foreach ($users as $eachuser) {
                        $displayuser = $eachuser['display_name'];
                        if ($absents = $absent
                            ->where('user_id', $eachuser['id_user'])
                            ->where('tanggal', $k)
                            ->where('bulan', $j)
                            ->where('tahun', $i)
                            ->findAll()
                        ) {
                            foreach ($absents as $item) {
                                $itemUser = $user->find($item['user_id']) ?>
                                <?php $itemUser['team_id'] == null || $itemUser['team_id'] == ' ' ?  $nameTeam = $role->find($itemUser['role_id'])['name'] : $nameTeam = $team->find($itemUser['team_id'])['name']  ?>
                                <tr>
                                    <th><?= $no ?></th>
                                    <td><?= $itemUser['display_name']  ?></td>
                                    <td><?= tgl_full($Day, $date) ?></td>
                                    <td><?= $item['jam_masuk'] ?></td>
                                    <td><?= $item['jam_keluar'] ?></td>
                                    <td><?= $nameTeam ?></td>
                                    <td><?= $role->find($itemUser['role_id'])['name'] ?></td>
                                    <td>
                                        <?= statusAbsent($item['jam_masuk'], $item['jam_keluar'], $eachuser['id_user']) ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('/absent/editabsent' . '/' . $eachuser['id_user'] . '/' . $date) ?>" class="badge badge-primary">Edit</a>

                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                        } else { ?>
                            <tr>
                                <th><?= $no ?></th>
                                <td><?= $displayuser ?></td>
                                <td><?= tgl_full($Day, $date) ?></td>
                                <td></td>
                                <td></td>
                                <td><?= $eachuser['team_id'] == ' ' || $eachuser['team_id'] == null ? $role->find($eachuser['role_id'])['name'] : $teamUser ?></td>
                                <td><?= $role->find($eachuser['role_id'])['name'] ?></td>
                                <td>
                                    <?= statusAbsent('', '', $eachuser['id_user']) ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('/absent/editabsent' . '/' . $eachuser['id_user'] . '/' . $date) ?>" class="badge badge-primary">Edit</a>
                                </td>
                            </tr>
                        <?php
                            $no++;
                        }
                    }
                }
            } else {
                if ($dUser) {
                    $users = $user->where('id_user', $isUser)->findAll();
                } else {
                    $users = $user->where('team_id', ' ')->findAll();
                }
                foreach ($users as $eachuser) {
                    $displayuser = $eachuser['display_name'];
                    if ($absents = $absent
                        ->where('user_id', $eachuser['id_user'])
                        ->where('tanggal', $k)
                        ->where('bulan', $j)
                        ->where('tahun', $i)
                        ->findAll()
                    ) {
                        foreach ($absents as $item) {
                            $itemUser = $user->find($item['user_id']) ?>
                            <?php $itemUser['team_id'] == null || $itemUser['team_id'] == ' ' ?  $nameTeam = $role->find($itemUser['role_id'])['name'] : $nameTeam = $team->find($itemUser['team_id'])['name']  ?>
                            <tr>
                                <th><?= $no ?></th>
                                <td><?= $itemUser['display_name']  ?></td>
                                <td><?= tgl_full($Day, $date) ?></td>
                                <td><?= $item['jam_masuk'] ?></td>
                                <td><?= $item['jam_keluar'] ?></td>
                                <td><?= $nameTeam ?></td>
                                <td><?= $role->find($itemUser['role_id'])['name'] ?></td>
                                <td>
                                    <?= statusAbsent($item['jam_masuk'], $item['jam_keluar'], $eachuser['id_user']) ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('/absent/editabsent' . '/' . $eachuser['id_user'] . '/' . $date) ?>" class="badge badge-primary">Edit</a>

                                </td>
                            </tr>
                        <?php
                            $no++;
                        }
                    } else { ?>
                        <tr>
                            <th><?= $no ?></th>
                            <td><?= $displayuser ?></td>
                            <td><?= tgl_full($Day, $date) ?></td>
                            <td></td>
                            <td></td>
                            <td><?= $eachuser['team_id'] == ' ' || $eachuser['team_id'] == null ? $role->find($eachuser['role_id'])['name'] : $teamUser ?></td>
                            <td><?= $role->find($eachuser['role_id'])['name'] ?></td>
                            <td>
                                <?= statusAbsent('', '', $eachuser['id_user']) ?>
                            </td>
                            <td>
                                <a href="<?= base_url('/absent/editabsent' . '/' . $eachuser['id_user'] . '/' . $date) ?>" class="badge badge-primary">Edit</a>
                            </td>
                        </tr>
<?php
                        $no++;
                    }
                }
            }
        endfor;
    endfor;
endfor;
