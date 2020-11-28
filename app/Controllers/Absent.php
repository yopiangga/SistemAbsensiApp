<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use function Complex\sec;

class Absent extends BaseController
{
    public function index()
    {
        return redirect()->to('dashboard');
    }
    public function check()
    {
        $dataLabel = [
            'UserModel' => $this->UserModel,
            'AbsentModel' => $this->AbsentModel,
        ];
        $data = [
            'labelAbsent' => view('absent/toggle', $dataLabel)
        ];
        return view('page/absent', $data);
    }
    public function listabsent($bulan = 0, $tahun = 0)
    {
        $bulan == 0 ? $bulan = date('m') : $bulan = $bulan;
        $tahun == 0 ? $tahun = date('Y') : $tahun = $tahun;
        $id = session('id');
        helper(['date', 'absent']);
        $hari = hari(date('D')) . ',';
        $hari .= tgl_indo(date('Y-m-d', mktime(0, 0, 0, $bulan, date('d'), $tahun)));
        $data = [
            'validation' => \Config\Services::validation(),
            'user' => $this->UserModel->find($id),
            'hari' => $hari,
            'absent' => $this->AbsentModel,
            'isBulan' => $bulan,
            'isTahun' => $tahun
        ];
        return view('page/listabsent', $data);
    }
    public function manageabsent($hari = null, $bulan = null, $tahun = null, $team = null, $user = null)
    {
        $id = session('id');
        helper(['date', 'absent']);
        $hari == null ? $hari = date('d') : $hari = $hari;
        $bulan == null ? $bulan = date('m') : $bulan = $bulan;
        $tahun == null ? $tahun = date('Y') : $tahun = $tahun;
        $user == null ? $user = session('id') : $user = $user;
        $team == null ? $team = 0 : $user = $user;
        $labelHari = hari($hari) . ',';
        $labelHari .= tgl_indo(date('Y-m-d', mktime(0, 0, 0, $bulan, $hari, $tahun)));
        $data = [
            'validation' => \Config\Services::validation(),
            'user' => $this->UserModel,
            'team' => $this->TeamModel,
            'role' => $this->RoleModel,
            'hari' => $labelHari,
            'absent' => $this->AbsentModel,
            'isTanggal' => $hari,
            'isBulan' => $bulan,
            'isTahun' => $tahun,
            'isTeam' => $team,
            'isUser' => $user,
        ];
        $allData = view('table/manageabsent', $data);
        $data = [
            'validation' => \Config\Services::validation(),
            'user' => $this->UserModel,
            'team' => $this->TeamModel,
            'role' => $this->RoleModel,
            'hari' => $labelHari,
            'absent' => $this->AbsentModel,
            'isHari' => $hari,
            'isBulan' => $bulan,
            'isTahun' => $tahun,
            'isTeam' => $team,
            'isUser' => $user,
        ];
        $allLabel = view('table/countabsentlabel', $data);
        $data = [
            'validation' => \Config\Services::validation(),
            'UserModel' => $this->UserModel,
            'user' => $this->UserModel->find($id),
            'users' => $this->UserModel->findAll(),
            'teams' => $this->TeamModel->findAll(),
            'hari' => $labelHari,
            'absent' => $this->AbsentModel,
            'isHari' => $hari,
            'isBulan' => $bulan,
            'isTahun' => $tahun,
            'isTeam' => $team,
            'isUser' => $user,
            'allData' => $allData,
            'allLabel' => $allLabel
        ];
        return view('page/manageabsent', $data);
    }

    public function editabsent($userId, $date)
    {
        $date = explode('-', $date);
        $tanggal = $date[2];
        $bulan = $date[1];
        $tahun = $date[0];
        $user = $this->UserModel->find($userId);
        if (!$this->request->getVar('submit'))
            $this->session->set('back', previous_url());
        if ($this->request->getVar('submit')) {
            if ($isAbsent = $this->AbsentModel
                ->where('user_id', $userId)
                ->where('tanggal', $tanggal)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun)
                ->first()
            ) {
                if ($this->request->getVar('status') == 'Izin') {
                    $data1 = [
                        'jam_masuk' => date('1:00:00'),
                        'jam_keluar' => date('1:00:00'),
                    ];
                    $this->AbsentModel->update($isAbsent['id_absent'], $data1);
                } else if ($this->request->getVar('status') == 'Hadir') {
                    $data1 = [
                        'jam_masuk' => $user['jam_masuk']
                    ];
                    $this->AbsentModel->update($isAbsent['id_absent'], $data1);
                } else if ($this->request->getVar('status') == 'Terlambat') {
                    $data1 = [
                        'jam_masuk' => date('H:i:s', strtotime($user['jam_masuk']) + jamkeint($user['tolerir_masuk']))
                    ];
                    $this->AbsentModel->update($isAbsent['id_absent'], $data1);
                } else {
                    $this->AbsentModel->delete($isAbsent['id_absent']);
                }
            } else {
                if ($this->request->getVar('status') == 'Izin') {
                    $data1 = [
                        'id_absent' =>  $this->Uuid->v4(),
                        'user_id' => $userId,
                        'tanggal' => $tanggal,
                        'bulan' => $bulan,
                        'tahun' => $tahun,
                        'jam_masuk' => date('1:00:00'),
                        'jam_keluar' => date('1:00:00'),
                    ];
                    $this->AbsentModel->insert($data1);
                } else if ($this->request->getVar('status') == 'Hadir') {
                    $data1 = [
                        'id_absent' =>  $this->Uuid->v4(),
                        'user_id' => $userId,
                        'tanggal' => $tanggal,
                        'bulan' => $bulan,
                        'tahun' => $tahun,
                        'jam_masuk' => $user['jam_masuk']
                    ];
                    $this->AbsentModel->insert($data1);
                } else if ($this->request->getVar('status') == 'Terlambat') {
                    $data1 = [
                        'id_absent' =>  $this->Uuid->v4(),
                        'user_id' => $userId,
                        'tanggal' => $tanggal,
                        'bulan' => $bulan,
                        'tahun' => $tahun,
                        'jam_masuk' => date('H:i:s', strtotime($user['jam_masuk']) + jamkeint($user['tolerir_masuk']))
                    ];
                    $this->AbsentModel->insert($data1);
                }
            }
            $this->session->setFlashdata('message', 'Status Absent sudah di ganti menjadi' . $this->request->getVar('status') . ', Terimakasih ^_^.');
            return redirect()->to(session('back'));
        }
        $data = [
            'user' => $this->UserModel->find($userId),
            'absent' => $this->AbsentModel,
            'date' => $date,
            'team' => $this->TeamModel,
            'role' => $this->RoleModel
        ];
        return view('page/editabsent', $data);
    }
    public function turn()
    {
        if (previous_url() == base_url('/absent/check')) {
            $user  = $this->UserModel->find(session('id'));
            $absent = $this->AbsentModel
                ->where('user_id', session('id'))
                ->where('tanggal', date('d'))
                ->where('bulan', date('m'))
                ->where('tahun', date('Y'))
                ->first();
            if (jamkeint(date('H:i:s')) > jamkeint($user['jam_masuk']) - jamkeint($user['tolerir_masuk']) && jamkeint(date('H:i:s')) < jamkeint($user['jam_keluar']) + jamkeint($user['tolerir_keluar'])) {
                if ($absent) {
                    if (jamkeint(date('H:i:s')) < jamkeint($user['jam_masuk']) + jamkeint($user['tolerir_masuk'])) {
                        if ($absent['jam_masuk']) {
                            $this->session->setFlashdata('message', 'Anda sudah absent,Terimakasih ^_^.');
                            return redirect()->back();
                        }
                    } else if (jamkeint(date('H:i:s')) < jamkeint($user['jam_keluar']) + jamkeint($user['tolerir_keluar'])) {
                        if ($absent['jam_keluar'] == "00:00:00") {
                            $data = [
                                'jam_keluar' => date('H:i:s'),
                            ];
                            $this->AbsentModel->update($absent['id_absent'], $data);
                            $this->session->setFlashdata('message', 'Anda berhasil absent,Terimakasih ^_^.');
                            return redirect()->back();
                        } else {
                            $this->session->setFlashdata('message', 'Anda sudah absent,Terimakasih ^_^.');
                            return redirect()->back();
                        }
                    } else {
                        $btnMasuk = '<button class="btn btn-secondary">Absen tidak ada</button>';
                    }
                } else {
                    if (jamkeint(date('H:i:s')) < jamkeint($user['jam_masuk']) + jamkeint($user['tolerir_masuk'])) {
                        $data = [
                            'id_absent' =>  $this->Uuid->v4(),
                            'user_id' => session('id'),
                            'jam_masuk' => date('H:i:s'),
                            'tanggal' => date('d'),
                            'bulan' => date('m'),
                            'tahun' => date('Y'),
                        ];
                        $this->AbsentModel->insert($data);
                        $this->session->setFlashdata('message', 'Anda sudah absent,Terimakasih ^_^.');
                        return redirect()->back();
                    } else {
                        $this->session->setFlashdata('message', 'Tidak ada absent,Terimakasih ^_^.');
                        return redirect()->back();
                    }
                }
            }
        }
        return redirect()->back();
    }
}
