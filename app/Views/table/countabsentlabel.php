<?php
$result = [
    'hadir' => 0,
    'terlambat' => 0,
    'izin' => 0,
    'alpha' => 0,
];
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
if ($dataUser['team_id'] != null || $dataUser['team_id'] != ' ') {
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
                            ->like('created_at', $i . '-' . date("m", $date1)  . '-' . date("d", $date1))
                            ->where('user_id', $eachuser['id_user'])
                            ->where('tanggal', $k)
                            ->where('bulan', $j)
                            ->where('tahun', $i)
                            ->findAll()
                        ) {
                            foreach ($absents as $item) {
                                if ($in = $item['jam_masuk']) {
                                    if (jamkeint($in) == jamkeint($item['jam_keluar'])) {
                                        $result['izin']++;
                                    } else if (jamkeint($in) <= jamkeint($eachuser['jam_masuk'])) {
                                        $result['hadir']++;
                                    } else if (jamkeint($in) >= jamkeint($eachuser['jam_masuk'])) {
                                        $result['terlambat']++;
                                    }
                                } else {
                                    $result['alpha']++;
                                }
                            }
                        } else {
                            $result['alpha']++;
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
                                if ($in = $item['jam_masuk']) {
                                    if (jamkeint($in) == jamkeint($item['jam_keluar'])) {
                                        $result['izin']++;
                                    } else if (jamkeint($in) <= jamkeint($eachuser['jam_masuk'])) {
                                        $result['hadir']++;
                                    } else if (jamkeint($in) >= jamkeint($eachuser['jam_masuk'])) {
                                        $result['terlambat']++;
                                    }
                                } else {
                                    $result['alpha']++;
                                }
                            }
                        } else {
                            $result['alpha']++;
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
                            if ($in = $item['jam_masuk']) {
                                if (jamkeint($in) == jamkeint($item['jam_keluar'])) {
                                    $result['izin']++;
                                } else if (jamkeint($in) <= jamkeint($eachuser['jam_masuk'])) {
                                    $result['hadir']++;
                                } else if (jamkeint($in) >= jamkeint($eachuser['jam_masuk'])) {
                                    $result['terlambat']++;
                                }
                            } else {
                                $result['alpha']++;
                            }
                        }
                    } else {
                        $result['alpha']++;
                    }
                }
            }
        endfor;
    endfor;
endfor;
?>
<td>
    <?= $result['hadir'] ?>
</td>
<td>
    <?= $result['terlambat'] ?>
</td>
<td>
    <?= $result['izin'] ?>
</td>
<td>
    <?= $result['alpha'] ?>
</td>