<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Message;

class Team extends BaseController
{
    public function index()
    {
        $user = $this->UserModel->find(session('id'));
        if ($user['team_id'] == null || $user['team_id'] == ' ') {
            $teams = $this->TeamModel->findAll();
        } else {
            $teams = $this->TeamModel->where('id_team', $user['team_id'])->findAll();
        }
        $data = [
            'teams' => $teams,
            'user' => $user
        ];
        return view('team/index', $data);
    }
    //--------------------------------------------------------------------
    public function createteam()
    {
        $validation = \config\Services::validation();
        if ($this->request->getVar('submit')) {
            $valid = $this->validate([
                'name' => [
                    'label' => 'Nama Team',
                    'rules' => 'required|is_unique[tbl_team.name]',
                    'errors' => [
                        'required' => '{field} Harus di isi',
                        'is_unique' => '{field} Sudah ada'
                    ]
                ],
            ]);
            if (!$valid) {
                return redirect()->to('/team/createteam')->withInput();
            } else {
                $data = [
                    'id_team' => $this->Uuid->v4(),
                    'name' => $this->request->getVar('name'),
                ];
                $this->TeamModel->insert($data);
                $this->session->setFlashdata('message', 'Team sudah di buat, Team : ' . $data['name']);
            }
            return redirect()->to('/team')->withInput();
        }
        $data = [
            'validation' => \config\Services::validation()
        ];
        return view('team/create', $data);
    }
    //--------------------------------------------------------------------
    public function editteam($id)
    {
        session();
        $data = [
            'validation' => \Config\Services::validation(),
            'team' => $this->TeamModel->find($id)
        ];
        $validation = \config\Services::validation();
        if ($this->request->getVar('submit')) {
            $ruleName = $this->request->getVar('name') == $data['team']['name'] ? 'required' : 'required|is_unique[tbl_team.name]';
            $valid = $this->validate([
                'name' => [
                    'label' => 'Nama Team',
                    'rules' => $ruleName,
                    'errors' => [
                        'required' => '{field} Harus di isi',
                        'is_unique' => '{field} Sudah ada'
                    ]
                ],
            ]);
            if (!$valid) {
                return redirect()->to('/team/editteam')->withInput();
            } else {
                $data = [
                    'name' => $this->request->getVar('name'),
                    'active' => $this->request->getVar('active'),
                ];
                $this->TeamModel->update($id, $data);
                $this->session->setFlashdata('message', 'Team sudah di update, Team : ' . $data['name']);
            }
            return redirect()->to('/team')->withInput();
        }
        return view('team/edit', $data);
    }
    //--------------------------------------------------------------------
    public function deleteteam($id)
    {
        if ($data = $this->TeamModel->find($id)) {
            $this->TeamModel->delete($id);
            $this->session->setFlashdata('message', 'Team sudah di hapus, Team : ' . $data['name']);
            return redirect()->to('/team')->withInput();
        }
        return redirect()->back();
    }
    //--------------------------------------------------------------------

}
