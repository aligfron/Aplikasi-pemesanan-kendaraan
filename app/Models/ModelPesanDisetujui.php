<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPesanDisetujui extends Model
{
    protected $table = "tb_pesan_disetujui";
    protected $primaryKey = "id_setuju";
    protected $protectFields = false;
    protected $allowedFields = ["id_kendaraan", "id_driver", "tgl_pesan", "tgl_kembali","id_atasan","tgl_disetujui"];

    function getAll()
    {
        $builder = $this->db->table('tb_pesan_disetujui');
        $builder->join('tb_kendaraan', "tb_kendaraan.id_kendaraan = tb_pesan_disetujui.id_kendaraan");
        $builder->join('tb_driver', "tb_driver.id_driver = tb_pesan_disetujui.id_driver");
        $builder->join('tb_login', "tb_login.userid = tb_pesan_disetujui.id_atasan");
        $query = $builder->get();
        return $query->getResult();
    }
}


