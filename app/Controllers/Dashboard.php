<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'user' => $this->UserModel,
            'absent' => $this->AbsentModel,
        ];
        return view('dashboard/index', $data);
    }


    //--------------------------------------------------------------------

}
