<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPesan extends Model
{
    protected $table = "tb_pesanan";
    protected $primaryKey = "id_pesanan";
    protected $protectFields = false;
    protected $allowedFields = ["id_kendaraan", "id_driver", "tgl_pesan", "tgl_kembali","id_atasan"];

    function getAll()
    {
        $builder = $this->db->table('tb_pesanan');
        $builder->join('tb_kendaraan', "tb_kendaraan.id_kendaraan = tb_pesanan.id_kendaraan");
        $builder->join('tb_driver', "tb_driver.id_driver = tb_pesanan.id_driver");
        $builder->join('tb_login', "tb_login.userid = tb_pesanan.id_atasan");
        $query = $builder->get();
        return $query->getResult();
    }
}


