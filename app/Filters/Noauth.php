<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Noauth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $SubmenuModel = new \App\Models\SubmenuModel;
        $RoleAccess = new \App\Models\RoleaccessModel;
        $MenuModel = new \App\Models\MenuModel;
        $UserModel = new \App\Models\UserModel;
        $request = \Config\Services::request();
        // Do something here
        if (!session('id')) {
            return redirect()->to(base_url('auth'));
        } else {
            if ($UserModel->where('id_user', session('id'))->first() == null) {
                session()->remove('id');
                return redirect()->to(base_url('auth'));
            }
        }
        $fullurl = '';
        $i = 0;
        foreach ($request->uri->getSegments() as $uri) {
            $fullurl = $fullurl . '/' . $uri;
            $i++;
            if ($i == 2) break;
        }
        $fullurl = substr($fullurl, 1);
        if ($MenuModel->join('tbl_role_access', 'tbl_menu.id_menu = tbl_role_access.menu_id')->where(['tbl_menu.url' => $fullurl, 'tbl_role_access.role_id' => $UserModel->where('id_user', session('id'))->first()['role_id']])->findAll()) {
        } else {
            if ($RoleAccess->join('tbl_sub_menu', 'tbl_sub_menu.menu_id = tbl_role_access.menu_id')->where(['tbl_sub_menu.url' => $fullurl, 'tbl_role_access.role_id' => $UserModel->where('id_user', session('id'))->first()['role_id']])->first()) {
            } else {
                $url = $MenuModel->join('tbl_role_access', 'tbl_menu.id_menu = tbl_role_access.menu_id')->where(['tbl_role_access.role_id' => $UserModel->where('id_user', session('id'))->first()['role_id']])->first();
                if ($url['url'] == null) {
                    $url = $MenuModel->join('tbl_role_access', 'tbl_menu.id_menu = tbl_role_access.menu_id')->join('tbl_sub_menu', 'tbl_sub_menu.menu_id = tbl_menu.id_menu')->where(['tbl_role_access.role_id' => $UserModel->where('id_user', session('id'))->first()['role_id']])->orderBy('tbl_menu.no_serial', 'ASC')->orderBy('tbl_sub_menu.no_serial', 'ASC')->first();
                    return redirect()->to(base_url($url['url']));
                } else {
                    return redirect()->to(base_url($url['url']));
                }
            }
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
