<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table      = 'tbl_menu';
    protected $primaryKey = 'id_menu';

    protected $returnType     = 'array';

    protected $allowedFields = ['id_menu', 'menu', 'icon', 'url', 'no_serial', 'is_active', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
}
