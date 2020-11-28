<?php

namespace App\Models;

use CodeIgniter\Database\MySQLi\Result;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'tbl_user';
    protected $primaryKey = 'id_user';

    protected $returnType     = 'array';

    protected $allowedFields = ["id_user", "username", "password", "display_name", "phone", "team_id", "role_id", "jam_masuk", "jam_keluar", "tolerir_masuk", "tolerir_keluar", "created_at", "updated_at"];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    public function login($username, $password)
    {
        if ($this->where('username', $username)->first() && password_verify($password, $this->where('username', $username)->first()['password'])) {
            session()->set('id', $this->where('username', $username)->first()['id_user']);
            return true;
        } else {
            return false;
        }
    }
}
