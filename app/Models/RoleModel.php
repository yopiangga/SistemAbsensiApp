<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table      = 'tbl_role';
    protected $primaryKey = 'id_role';
    protected $returnType     = 'array';
    protected $allowedFields = ['id_role', 'name', 'is_active', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
