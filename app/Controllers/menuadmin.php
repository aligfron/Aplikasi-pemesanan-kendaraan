<?php

namespace App\Controllers;

use App\Models\ModelDriver;
use App\Models\ModelKendaraan;
use App\Models\ModelLogin;
use App\Models\ModelPesan;
use App\Models\ModelPesanDisetujui;

class menuadmin extends BaseController
{
    protected $session, $ModelKendaraan, $ModelDriver, $ModelPesan, $ModelPesanDisetujui, $modelLogin;
    function __construct()
    {

        $this->session = \Config\Services::session();
        $this->session->start();
        $this->modelLogin = new ModelLogin();
        $this->ModelKendaraan = new ModelKendaraan();
        $this->ModelDriver = new ModelDriver();
        $this->ModelPesan = new ModelPesan();
        $this->ModelPesanDisetujui = new ModelPesanDisetujui();
    }
    public function index(): string
    {
        return view('admin/index');
    }
    public function datakendaraan()
    {
        if (!$this->session->has('logged_in')) {
            return redirect()->to('/Home');
        }
        if ($this->session->get('idlevel') != 2) {
            return redirect()->to('/menuatasan');
        }
        $validation = \Config\Services::validation();
        $kendaraan = $this->ModelKendaraan->where('status', 'Ada')->findAll();
        $data = [
            'title' => 'Data Kendaraan',
            'kendaraan' => $kendaraan
        ];
        return view('admin/datakendaraan', $data);
    }
    public function datadriver()
    {
        if (!$this->session->has('logged_in')) {
            return redirect()->to('/Home');
        }
        if ($this->session->get('idlevel') != 2) {
            return redirect()->to('/menuatasan');
        }
        $validation = \Config\Services::validation();
        $driver = $this->ModelDriver->findAll();
        $data = [
            'title' => 'Data Driver',
            'driver' => $driver
        ];
        return view('admin/datadriver', $data);
    }
    public function dipesan()
    {
        if (!$this->session->has('logged_in')) {
            return redirect()->to('/Home');
        }
        if ($this->session->get('idlevel') != 2) {
            return redirect()->to('/menuatasan');
        }
        $validation = \Config\Services::validation();
        $pesan = $this->ModelPesan->getAll();
        $data = [
            'title' => 'Data Pesanan',
            'pesan' => $pesan
        ];
        return view('admin/dipesan',$data);
    }
    public function pesankendaraan()
    {
        if (!$this->session->has('logged_in')) {
            return redirect()->to('/Home');
        }
        if ($this->session->get('idlevel') != 2) {
            return redirect()->to('/menuatasan');
        }
        $atasan = $this->modelLogin->where('userlevelid', '1')->findAll();
        $kendaraan = $this->ModelKendaraan->where('status', 'Ada')->findAll();
        $driver = $this->ModelDriver->findAll();
        $data = [
            'title' => 'Data Pesanan',
            'atasan' => $atasan,
            'kendaraan' => $kendaraan,
            'driver' => $driver

        ];
        return view('admin/pesankendaraan', $data);
    }

public function prosespesan(){
    if (!$this->session->has('logged_in')) {
        return redirect()->to('/Home');
    }
    if ($this->session->get('idlevel') != 2) {
        return redirect()->to('/menuatasan');
    }
    $kendaraan = $this->request->getVar('kendaraan');
    $driver = $this->request->getVar('driver');
    $tgl_pesan = $this->request->getVar('tgl_pesan');
    $tgl_kembali = $this->request->getVar('tgl_kembali');
    $atasan = $this->request->getVar('atasan');
    $this->ModelPesan->save(
        [
            'id_kendaraan'     => $kendaraan,
            'id_driver'          => $driver,
            'tgl_pesan'           => $tgl_pesan,
            'tgl_kembali'           => $tgl_kembali,
            'id_atasan'       => $atasan
        ]
    );
    return redirect()->to('/menuadmin/dipesan');
}


    public function disetujui()
    {
        if (!$this->session->has('logged_in')) {
            return redirect()->to('/Home');
        }
        if ($this->session->get('idlevel') != 2) {
            return redirect()->to('/menuatasan');
        }
        $validation = \Config\Services::validation();
        $disetujui = $this->ModelPesanDisetujui->getAll();
        $data = [
            'title' => 'Data Setuju',
            'disetujui' => $disetujui
        ];
        return view('admin/disetujui',$data);
    }
    public function laporan()
    {
        return view('admin/laporan');
    }
    public function profil()
    {
        return view('admin/profil');
    }
}