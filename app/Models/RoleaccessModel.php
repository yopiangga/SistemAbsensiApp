<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleaccessModel extends Model
{
    protected $table      = 'tbl_role_access';
    protected $primaryKey = 'id_role_access';

    protected $returnType     = 'array';

    protected $allowedFields = ['id_role_access', 'role_id', 'menu_id', 'created_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
}
