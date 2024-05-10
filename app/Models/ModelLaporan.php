<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLaporan extends Model
{
    protected $table = "tb_laporan";
    protected $primaryKey = "id_laporan";
    protected $protectFields = false;
    protected $allowedFields = ["id_kendaraan", "id_driver", "tgl_pesan", "tgl_kembali","id_atasan","tgl_disetujui"];

    function getAll()
    {
        $builder = $this->db->table('tb_laporan');
        $builder->join('tb_kendaraan', "tb_kendaraan.id_kendaraan = tb_laporan.id_kendaraan");
        $builder->join('tb_driver', "tb_driver.id_driver = tb_laporan.id_driver");
        $builder->join('tb_login', "tb_login.userid = tb_laporan.id_atasan");
        $query = $builder->get();
        return $query->getResult();
    }
}


