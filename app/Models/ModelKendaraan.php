<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKendaraan extends Model
{
    protected $table = "tb_kendaraan";
    protected $primaryKey = "id_kendaraan";
    protected $protectFields = false;
    protected $allowedFields = ["nama_kendaraan", "no_plat", "jenis_kendaraan", "status"];
}
