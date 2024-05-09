<?php

namespace App\Controllers;

use App\Models\ModelPesan;

class menuatasan extends BaseController
{
    protected $session, $ModelKendaraan, $ModelDriver, $ModelPesan, $ModelPesanDisetujui, $modelLogin;
    function __construct()
    {

        $this->session = \Config\Services::session();
        $this->session->start();
        $this->ModelPesan = new ModelPesan();
    }
public function index(): string
    {
        if (!$this->session->has('logged_in')) {
            return redirect()->to('/Home');
        }
        $validation = \Config\Services::validation();
        $pesan = $this->ModelPesan->getAll();
        $data = [
            'title' => 'Data Pesanan',
            'pesan' => $pesan
        ];
        return view('atasan/dipesan',$data);
    }
}