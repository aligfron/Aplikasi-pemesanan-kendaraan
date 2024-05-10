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
        if (!$this->session->has('logged_in')) {
            return redirect()->to('/Home');
        }
        if ($this->session->get('idlevel') != 2) {
            return redirect()->to('/menuatasan');
        }
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
    $db      = \Config\Database::connect();
        $builder = $db->table('tb_kendaraan');
        $builder->where('id_kendaraan', $kendaraan);
        $builder->update(
            [
                'status' => 'Dipesan',
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
    public function prosessetuju($id_setuju)
    {
        if (!$this->session->has('logged_in')) {
            return redirect()->to('/Home');
        }
        if ($this->session->get('idlevel') != 2) {
            return redirect()->to('/menuatasan');
        }
        $id_kendaraan = $this->request->getVar('kendaraan');
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_kendaraan');
        $builder->where('id_kendaraan', $id_kendaraan);
        $builder->update(
            [
                'status' => 'Ada',
            ]
        );
        $this->ModelPesanDisetujui->delete($id_setuju);
        return redirect()->to('/menuadmin/disetujui');
    }
    public function tambahkendaraan()
    {
        if (!$this->session->has('logged_in')) {
            return redirect()->to('/Home');
        }
        if ($this->session->get('idlevel') != 2) {
            return redirect()->to('/menuatasan');
        }
        
        return view('admin/tambahkendaraan');
    }
    public function prosestambah()
    {
        if (!$this->session->has('logged_in')) {
            return redirect()->to('/Home');
        }
        if ($this->session->get('idlevel') != 2) {
            return redirect()->to('/menuatasan');
        }
        $nama = $this->request->getVar('nama');
        $no = $this->request->getVar('no');
        $jenis = $this->request->getVar('jenis');
        $status = 'Ada';
        $this->ModelKendaraan->save(
            [
                'nama_kendaraan' => $nama,
                'no_plat' => $no,
                'jenis_kendaraan' => $jenis,
                'status' => $status
            ]
        );
        session()->setFlashdata('pesan', 'Data Berhasil di tambah');
        return redirect()->to('/menuadmin/datakendaraan');
    }
    public function delete_kendaraan($id_kendaraan)
    {
        if (!$this->session->has('logged_in')) {
            return redirect()->to('/Login');
        }
        if ($this->session->get('idlevel') != 2) {
            return redirect()->to('/menuadmin');
        }
        $this->ModelKendaraan->delete($id_kendaraan);

        session()->setFlashdata('pesan', 'Data Berhasil dihapus');
        return redirect()->to('/menuadmin/datakendaraan');
    }
    public function edit($id_kendaraan)
    {
        if (!$this->session->has('logged_in')) {
            return redirect()->to('/Login');
        }
        if ($this->session->get('idlevel') != 2) {
            return redirect()->to('/menuadmin');
        }
        $kendaraan = $this->ModelKendaraan->find($id_kendaraan);
        $data = [
            'title' => 'Data Pesanan',
            'kendaraan' => $kendaraan
        ];
        return view('admin/editkendaraan', $data);
    }
    public function update($id_kendaraan)
    {
        if (!$this->session->has('logged_in')) {
            return redirect()->to('/Login');
        }
        if ($this->session->get('idlevel') != 2) {
            return redirect()->to('/menuadmin');
        }
        $nama = $this->request->getVar('nama');
        $no = $this->request->getVar('no');
        $jenis = $this->request->getVar('jenis');
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_kendaraan');
        $builder->where('id_kendaraan', $id_kendaraan);
        $builder->update(
            [
                'nama_kendaraan' => $nama,
                'no_plat' => $no,
                'jenis_kendaraan' => $jenis
            ]
        );
        session()->setFlashdata('pesan', 'Data Berhasil di edit');
        return redirect()->to('/menuadmin/datakendaraan');
    }
    public function tbhdriver()
    {
        if (!$this->session->has('logged_in')) {
            return redirect()->to('/Login');
        }
        if ($this->session->get('idlevel') != 2) {
            return redirect()->to('/menuadmin');
        }
        return view('admin/tambahdatadriver');
    }
    public function prosestambahdriver()
    {
        if (!$this->session->has('logged_in')) {
            return redirect()->to('/Home');
        }
        if ($this->session->get('idlevel') != 2) {
            return redirect()->to('/menuatasan');
        }
        $nama = $this->request->getVar('nama');
        $no = $this->request->getVar('no');
        $this->ModelDriver->save(
            [
                'nama_driver' => $nama,
                'no_hp' => $no
            ]
        );
        session()->setFlashdata('pesan', 'Data Berhasil di tambah');
        return redirect()->to('/menuadmin/datadriver');
    }
    public function delete_driver($id_driver)
    {
        if (!$this->session->has('logged_in')) {
            return redirect()->to('/Login');
        }
        if ($this->session->get('idlevel') != 2) {
            return redirect()->to('/menuadmin');
        }
        $this->ModelDriver->delete($id_driver);

        session()->setFlashdata('pesan', 'Data Berhasil dihapus');
        return redirect()->to('/menuadmin/datadriver');
    }
    public function editdriver($id_driver)
    {
        if (!$this->session->has('logged_in')) {
            return redirect()->to('/Login');
        }
        if ($this->session->get('idlevel') != 2) {
            return redirect()->to('/menuadmin');
        }
        $driver = $this->ModelDriver->find($id_driver);
        $data = [
            'title' => 'Data Pesanan',
            'driver' => $driver
        ];
        return view('admin/editdriver', $data);
    }
    public function updatedriver($id_driver)
    {
        if (!$this->session->has('logged_in')) {
            return redirect()->to('/Login');
        }
        if ($this->session->get('idlevel') != 2) {
            return redirect()->to('/menuadmin');
        }
        $nama = $this->request->getVar('nama');
        $no = $this->request->getVar('no');
        $db      = \Config\Database::connect();
        $builder = $db->table('tb_driver');
        $builder->where('id_driver', $id_driver);
        $builder->update(
            [
                'nama_driver' => $nama,
                'no_hp' => $no
            ]
        );
        session()->setFlashdata('pesan', 'Data Berhasil di edit');
        return redirect()->to('/menuadmin/datadriver');
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