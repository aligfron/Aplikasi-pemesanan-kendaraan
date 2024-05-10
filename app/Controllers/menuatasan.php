<?php

namespace App\Controllers;

use App\Models\ModelLaporan;
use App\Models\ModelPesan;
use App\Models\ModelPesanDisetujui;

class menuatasan extends BaseController
{
    protected $session, $ModelKendaraan, $ModelDriver, $ModelPesan, $ModelPesanDisetujui, $modelLogin, $ModelLaporan;
    function __construct()
    {

        $this->session = \Config\Services::session();
        $this->session->start();
        $this->ModelPesan = new ModelPesan();
        $this->ModelPesanDisetujui = new ModelPesanDisetujui();
        $this->ModelLaporan = new ModelLaporan();
    }
public function index()
    {
        if (!$this->session->has('logged_in')) {
            return redirect()->to('/Home/index');
        }
        $validation = \Config\Services::validation();
        $pesan = $this->ModelPesan->getAll();
        $data = [
            'title' => 'Data Pesanan',
            'pesan' => $pesan
        ];
        return view('atasan/dipesan',$data);
    }
    public function setujui($id_pesanan){
        if (!$this->session->has('logged_in')) {
            return redirect()->to('/Home/index');
        }
        $id_kendaraan = $this->request->getVar('kendaraan');
        $driver = $this->request->getVar('driver');
        $tgl_pesan = $this->request->getVar('tgl_pesan');
        $tgl_kembali = $this->request->getVar('tgl_kembali');
        $atasan = $this->request->getVar('userid');
        $tgl_setuju = date("Y-m-d");
        $this->ModelPesanDisetujui->save(
            [
                'id_kendaraan'     => $id_kendaraan,
                'id_driver'          => $driver,
                'tgl_pesan'           => $tgl_pesan,
                'tgl_kembali'           => $tgl_kembali,
                'id_atasan'       => $atasan,
                'tgl_disetujui' => $tgl_setuju
            ]
        );
        $this->ModelLaporan->save(
            [
                'id_kendaraan'     => $id_kendaraan,
                'id_driver'          => $driver,
                'tgl_pesan'           => $tgl_pesan,
                'tgl_kembali'           => $tgl_kembali,
                'id_atasan'       => $atasan,
                'tgl_disetujui' => $tgl_setuju
            ]
        );

        $db      = \Config\Database::connect();
        $builder = $db->table('tb_kendaraan');
        $builder->where('id_kendaraan', $id_kendaraan);
        $builder->update(
            [
                'status' => 'Disetujui',
            ]
        );
        $this->ModelPesan->delete($id_pesanan);
        return redirect()->to('/menuatasan');
    }
}