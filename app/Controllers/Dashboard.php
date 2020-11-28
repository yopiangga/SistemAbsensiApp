<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'validation' => \Config\Services::validation(),
        ];
        return view('dashboard/index', $data);
    }


    //--------------------------------------------------------------------

}
