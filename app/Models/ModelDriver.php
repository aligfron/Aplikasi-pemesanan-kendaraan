<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDriver extends Model
{
    protected $table = "tb_driver";
    protected $primaryKey = "id_driver";
    protected $protectFields = false;
    protected $allowedFields = ["nama_driver", "no_hp"];
}
