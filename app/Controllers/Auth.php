<?php

namespace App\Controllers;

use CodeIgniter\Validation\Validation;

class Auth extends BaseController
{
    public function index()
    {
        if (isset($_POST["submit"])) {
            if ($this->validate([
                'username' => 'required',
                'password' => 'required'
            ])) {
                return $this->UserModel->login($this->request->getVar('username'), $this->request->getVar('password'));
            } else {
                return redirect()->to(base_url('auth'))->withInput();
            }
        }
        $data['body'] = 'login-page';
        $data['validation'] = \config\Services::validation();
        echo view('auth/login', $data);
    }
    //--------------------------------------------------------------------
    public function user_login()
    {
        $validation = \config\Services::validation();
        $valid = $this->validate([
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'error' => [
                    'required' => '{field} Tidak boleh kosong'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'error' => [
                    'required' => '{field} Tidak boleh kosong!'
                ]
            ]
        ]);
        if ($this->request->isAJAX()) {
            if (!$valid) {
                $msg = ['error' => [
                    'username' => $validation->getError('username'),
                    'password' => $validation->getError('password'),
                ]];
            } else {
                if ($this->UserModel->login($this->request->getVar('username'), $this->request->getVar('password'))) {
                    $msg = ['success' => true];
                } else {
                    $msg = ['error' => [
                        'message' => 'Username atau Password salah',
                    ]];
                }
            }
            return json_encode($msg);
        } else {
            return redirect()->back();
        }
    }
    public function logout()
    {
        session()->remove('id');
        return redirect()->to(base_url('auth'));
    }
    //--------------------------------------------------------------------

}
