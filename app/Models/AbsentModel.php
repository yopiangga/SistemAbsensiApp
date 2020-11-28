<?php

namespace App\Models;

use CodeIgniter\Database\MySQLi\Result;
use CodeIgniter\Model;

class AbsentModel extends Model
{
    protected $table      = 'tbl_absent';
    protected $primaryKey = 'id_absent';

    protected $returnType     = 'array';

    protected $allowedFields = ["id_absent", "user_id", "jam_masuk", "jam_keluar", "tanggal", "bulan", "tahun", "created_at", "updated_at"];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
