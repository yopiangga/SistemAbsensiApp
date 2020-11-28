<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Message;

class User extends BaseController
{
    public function index()
    {
        $user = $this->UserModel->find(session('id'));
        if ($user['team_id'] == null || $user['team_id'] == ' ') {
            $users = $this->UserModel->findAll();
        } else {
            $users = $this->UserModel->where('id_user', session('id'))->findAll();
        }
        $data = [
            'validation' => \Config\Services::validation(),
            'users' => $users,
            'role' => $this->RoleModel,
            'team' => $this->TeamModel
        ];
        return view('user/index', $data);
    }
    public function adduser()
    {
        if ($this->request->getVar('submit')) {
            if ($this->request->getVar('role') == "131f024e-2627-11eb-8fd9-54ab3af6eea6") {
                $dataTeam = $this->TeamModel->find($this->request->getVar('team'));
                if ($dataTeam['leader_id'] && $dataTeam['leader_id'] != ' ') {
                    $valid = $this->validate([
                        'name' => [
                            'label' => 'Nama',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Harus di isi',
                                'is_unique' => '{field} Sudah ada'
                            ]
                        ],
                        'phone' => [
                            'label' => 'Phone',
                            'rules' => 'required|is_unique[tbl_user.phone]',
                            'errors' => [
                                'required' => '{field} Harus di isi',
                                'is_unique' => '{field} Sudah ada'
                            ]
                        ],
                        'username' => [
                            'label' => 'Username',
                            'rules' => 'required|is_unique[tbl_user.username]',
                            'errors' => [
                                'required' => '{field} Harus di isi',
                                'is_unique' => '{field} Sudah ada'
                            ]
                        ],
                        'password' => [
                            'label' => 'Passwrod',
                            'rules' => 'required|min_length[8]',
                            'errors' => [
                                'required' => '{field} Harus di isi',
                                'min_length' => '{field} Harus lebih dari 8 karakter'
                            ]
                        ],
                        'team' => [
                            'label' => 'Team',
                            'rules' => 'max_length[1]',
                            'errors' => [
                                'max_length' => '{field} Sudah ada leader'
                            ]
                        ],
                        'jam_masuk' => [
                            'label' => 'Jam Masuk',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Harus di isi',
                            ]
                        ],
                        'jam_keluar' => [
                            'label' => 'Jam Keluar',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Harus di isi',
                            ]
                        ],
                        'tolerir_masuk' => [
                            'label' => 'Jam Tolerir Masuk',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Harus di isi',
                            ]
                        ],
                        'tolerir_keluar' => [
                            'label' => 'Jam Tolerir Keluar',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Harus di isi',
                            ]
                        ],
                    ]);
                } else {
                    $valid = $this->validate([
                        'name' => [
                            'label' => 'Nama',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Harus di isi',
                                'is_unique' => '{field} Sudah ada'
                            ]
                        ],
                        'phone' => [
                            'label' => 'Phone',
                            'rules' => 'required|is_unique[tbl_user.phone]',
                            'errors' => [
                                'required' => '{field} Harus di isi',
                                'is_unique' => '{field} Sudah ada'
                            ]
                        ],
                        'username' => [
                            'label' => 'Username',
                            'rules' => 'required|is_unique[tbl_user.username]',
                            'errors' => [
                                'required' => '{field} Harus di isi',
                                'is_unique' => '{field} Sudah ada'
                            ]
                        ],
                        'password' => [
                            'label' => 'Passwrod',
                            'rules' => 'required|min_length[8]',
                            'errors' => [
                                'required' => '{field} Harus di isi',
                                'min_length' => '{field} Harus lebih dari 8 karakter'
                            ]
                        ],
                        'jam_masuk' => [
                            'label' => 'Jam Masuk',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Harus di isi',
                            ]
                        ],
                        'jam_keluar' => [
                            'label' => 'Jam Keluar',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Harus di isi',
                            ]
                        ],
                        'tolerir_masuk' => [
                            'label' => 'Jam Tolerir Masuk',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Harus di isi',
                            ]
                        ],
                        'tolerir_keluar' => [
                            'label' => 'Jam Tolerir Keluar',
                            'rules' => 'required',
                            'errors' => [
                                'required' => '{field} Harus di isi',
                            ]
                        ],
                    ]);
                }
            } else {
                $valid = $this->validate([
                    'name' => [
                        'label' => 'Nama',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus di isi',
                            'is_unique' => '{field} Sudah ada'
                        ]
                    ],
                    'phone' => [
                        'label' => 'Phone',
                        'rules' => 'required|is_unique[tbl_user.phone]',
                        'errors' => [
                            'required' => '{field} Harus di isi',
                            'is_unique' => '{field} Sudah ada'
                        ]
                    ],
                    'username' => [
                        'label' => 'Username',
                        'rules' => 'required|is_unique[tbl_user.username]',
                        'errors' => [
                            'required' => '{field} Harus di isi',
                            'is_unique' => '{field} Sudah ada'
                        ]
                    ],
                    'password' => [
                        'label' => 'Passwrod',
                        'rules' => 'required|min_length[8]',
                        'errors' => [
                            'required' => '{field} Harus di isi',
                            'min_length' => '{field} Harus lebih dari 8 karakter'
                        ]
                    ],
                    'jam_masuk' => [
                        'label' => 'Jam Masuk',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus di isi',
                        ]
                    ],
                    'jam_keluar' => [
                        'label' => 'Jam Keluar',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus di isi',
                        ]
                    ],
                    'tolerir_masuk' => [
                        'label' => 'Jam Tolerir Masuk',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus di isi',
                        ]
                    ],
                    'tolerir_keluar' => [
                        'label' => 'Jam Tolerir Keluar',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus di isi',
                        ]
                    ],
                ]);
            }
            if (!$valid) {
                return redirect()->to('/user/adduser')->withInput();
            } else {
                $this->request->getVar('role') == "5f8731b9-9e73-4d0d-b37e-4dc4a981bd50" ? $team = ' ' : $team = $this->request->getVar('team');
                $data = [
                    'id_user' => $this->Uuid->v4(),
                    'username' => $this->request->getVar('username'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'display_name' => $this->request->getVar('name'),
                    'phone' => $this->request->getVar('phone'),
                    'team_id' => $team,
                    'role_id' => $this->request->getVar('role'),
                    'jam_masuk' => $this->request->getVar('jam_masuk'),
                    'jam_keluar' => $this->request->getVar('jam_keluar'),
                    'tolerir_masuk' => $this->request->getVar('tolerir_masuk'),
                    'tolerir_keluar' => $this->request->getVar('tolerir_masuk'),
                ];
                if ($data['role_id'] == "131f024e-2627-11eb-8fd9-54ab3af6eea6") {
                    $team = [
                        'leader_id' => $data['id_user']
                    ];
                    $this->TeamModel->update($data['team_id'], $team);
                }
                $this->UserModel->insert($data);
                $this->session->setFlashdata('message', 'User sudah di buat, User : ' . $data['display_name']);
            }
            return redirect()->to('/user')->withInput();
        }
        $user = $this->UserModel->find(session('id'));
        if ($user['team_id'] == null || $user['team_id'] == ' ') {
            $roles = $this->RoleModel->findAll();
        } else {
            $roles = $this->RoleModel->where('id_role', '26208e31-2627-11eb-8fd9-54ab3af6eea6')->findAll();
        }
        $data = [
            'validation' => \Config\Services::validation(),
            'teams' => $this->TeamModel->findAll(),
            'roles' => $roles
        ];
        return view('user/adduser', $data);
    }
    //--------------------------------------------------------------------
    public function edituser($id = null)
    {
        if ($this->UserModel->find($id)) {
            session();
            $user = $this->UserModel->find(session('id'));
            if ($user['team_id'] == null || $user['team_id'] == ' ') {
                $roles = $this->RoleModel->findAll();
            } else {
                $roles = $this->RoleModel->where('id_role', $user['role_id'])->findAll();
            }
            $data = [
                'validation' => \Config\Services::validation(),
                'user' => $this->UserModel->find($id),
                'teams' => $this->TeamModel->findAll(),
                'roles' => $roles
            ];
            $validation = \config\Services::validation();
            if ($this->request->getVar('submit')) {
                $valid = $this->validate([
                    'name' => [
                        'label' => 'Nama Team',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus di isi',
                            'is_unique' => '{field} Sudah ada'
                        ]
                    ],
                    'jam_masuk' => [
                        'label' => 'Jam Masuk',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus di isi',
                        ]
                    ],
                    'jam_keluar' => [
                        'label' => 'Jam Keluar',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus di isi',
                        ]
                    ],
                    'tolerir_masuk' => [
                        'label' => 'Jam Tolerir Masuk',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus di isi',
                        ]
                    ],
                    'tolerir_keluar' => [
                        'label' => 'Jam Tolerir Keluar',
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus di isi',
                        ]
                    ],
                ]);
                if (!$valid) {
                    return redirect()->to('/user/edituser/' . $id)->withInput();
                } else {
                    if ($this->request->getVar('role') == "5f8731b9-9e73-4d0d-b37e-4dc4a981bd50") {
                        $data = [
                            'display_name' => $this->request->getVar('name'),
                            'team_id' => NULL,
                            'role_id' => $this->request->getVar('role'),
                            'jam_masuk' => $this->request->getVar('jam_masuk'),
                            'jam_keluar' => $this->request->getVar('jam_keluar'),
                            'tolerir_masuk' => $this->request->getVar('tolerir_masuk'),
                            'tolerir_keluar' => $this->request->getVar('tolerir_masuk'),
                        ];
                    } else {
                        $data = [
                            'display_name' => $this->request->getVar('name'),
                            'team_id' => $this->request->getVar('team'),
                            'role_id' => $this->request->getVar('role'),
                            'jam_masuk' => $this->request->getVar('jam_masuk'),
                            'jam_keluar' => $this->request->getVar('jam_keluar'),
                            'tolerir_masuk' => $this->request->getVar('tolerir_masuk'),
                            'tolerir_keluar' => $this->request->getVar('tolerir_masuk'),
                        ];
                    }
                    $this->UserModel->update($id, $data);
                    $this->session->setFlashdata('message', 'Team sudah di update, Team : ' . $data['display_name']);
                }
                return redirect()->to('/user');
            }
            return view('user/edit', $data);
        }
        return redirect()->back();
    }
    //--------------------------------------------------------------------
    public function detailuser($id = null)
    {
        if ($this->UserModel->find($id)) {
            $data = [
                'user' => $this->UserModel->find($id),
                'role' => $this->RoleModel,
                'team' => $this->TeamModel
            ];
            return view('user/detail', $data);
        }
        return redirect()->back();
    }
    //--------------------------------------------------------------------
    public function deleteuser($id = null)
    {
        if ($data = $this->UserModel->find($id)) {
            $this->session->setFlashdata('message', 'User sudah di delete, User : ' . $data['display_name']);
            $user = $this->UserModel->find($id);
            if ($user['role_id'] == "131f024e-2627-11eb-8fd9-54ab3af6eea6") {
                $data = [
                    "leader_id" => ' '
                ];
                $this->TeamModel->update($user['team_id'], $data);
            }
            $this->UserModel->delete($id);
            return redirect()->to('/user');
        }
        return redirect()->back();
    }
}
