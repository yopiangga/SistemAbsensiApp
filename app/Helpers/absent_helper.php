<?php
function jamkeint($jam)
{
    $pecahkan = explode(':', $jam);
    $jam = $pecahkan[0];
    $menit = $pecahkan[1];
    $detik = $pecahkan[2];
    return $detik + ($menit * 60) + ($jam * 3600);
}

function statusAbsent($in = null, $out = null, $id)
{
    $UserModel = new \App\Models\UserModel;
    $user = $UserModel->find($id);
    if ($in != null && $out != null) {
        if (jamkeint($in) == jamkeint($out)) {
            return '<div class="badge badge-info">Izin</div>';
        } else if (jamkeint($in) >= jamkeint($user['jam_masuk'])) {
            return '<div class="badge badge-warning">Terlambat</div>';
        } else if (jamkeint($in) <= jamkeint($user['jam_masuk'])) {
            return '<div class="badge badge-success">Hadir</div>';
        }
    } else {
        return '<div class="badge badge-danger">Alpha</div>';
    }
}
function statusAbsentLabel($in = null, $out = null)
{
    $UserModel = new \App\Models\UserModel;
    $user = $UserModel->find(session('id'));
    if ($in != null && $out != null) {
        if (jamkeint($in) == jamkeint($out)) {
            return 'Izin';
        } else if (jamkeint($in) >= jamkeint($user['jam_masuk'])) {
            return 'Terlambat';
        } else if (jamkeint($in) <= jamkeint($user['jam_masuk'])) {
            return 'Hadir';
        }
    } else {
        return 'Alpha';
    }
}
function countStatusAbsent($status, $date, $year)
{
    $AbsentModel = new \App\Models\AbsentModel;
    $UserModel = new \App\Models\UserModel;
    $date > 10 ? $date : $date = '0' . $date;
    $datas = $AbsentModel
        ->where([
            'user_id' => session('id'),
            'bulan' => $date,
            'tahun' => $year
        ])->findAll();
    $user = $UserModel->find(session('id'));
    $result = 0;
    foreach ($datas as $data) {
        switch ($status) {
            case 'hadir':
                if (jamkeint($data['jam_masuk']) >= jamkeint($user['jam_masuk']) - jamkeint($user['tolerir_masuk'])   && jamkeint($data['jam_masuk']) <= jamkeint($user['jam_masuk'])) {
                    $result++;
                }
                break;
            case 'terlambat':
                if (jamkeint($data['jam_masuk']) >= jamkeint($user['jam_masuk'])) {
                    $result++;
                }
                break;
            case 'izin':
                if (jamkeint($data['jam_masuk']) == jamkeint($data['jam_keluar'])) {
                    $result++;
                }
                break;
        }
    }
    if ($status == 'alpha') {
        $max_date = 31;
        for ($i = 0; $i <= $max_date; $i++) {
            $date1 = mktime(0, 0, 0, $date, 32 - $i, $year);
            $isdate = date("Y-m-d", $date1);
            if ((int)date("m", $date1) != $date) {
                continue;
            } else if ((int)date("d", $date1) > date('d') && (int)date("m", $date1) == date('m')) continue;
            $absent = $AbsentModel
                ->where([
                    'user_id' => session('id'),
                    'tanggal' => date("d", $date1),
                    'bulan' => date("m", $date1),
                    'tahun' => date("Y", $date1),
                ])
                ->first();
            $in = $absent ? $absent['jam_masuk'] : '';
            $out = $absent ? $absent['jam_keluar'] : '';
            if ($in == null && $out  == null) {
                $result++;
            }
        }
    }
    return $result;
}
