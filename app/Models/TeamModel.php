<?php

namespace App\Models;

use CodeIgniter\Database\MySQLi\Result;
use CodeIgniter\Model;

class TeamModel extends Model
{
    protected $table      = 'tbl_team';
    protected $primaryKey = 'id_team';

    protected $returnType     = 'array';

    protected $allowedFields = ["id_team", "name", "leader_id", "active", "created_at", "updated_at"];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
