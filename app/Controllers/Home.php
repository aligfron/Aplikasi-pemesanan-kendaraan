<?php

namespace App\Controllers;

use App\Models\ModelLogin;

class Home extends BaseController
{
    protected $session;


    function __construct()
    {

        $this->session = \Config\Services::session();
        $this->session->start();
    }
    public function index()
    {
        return view('index');
    }
    public function cekUser()
    {
        $email = $this->request->getPost('email');
        $pass = $this->request->getVar('pass');

        $validation = \Config\Services::validation();
        $valid = $this->validate(
            [
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'pass' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ]
            ]
        );
        if (!$valid) {
            $sessError = [
                'errEmail' => $validation->getError('email'),
                'errPassword' => $validation->getError('pass')
            ];
            session()->setFlashdata($sessError);

            return redirect()->to(site_url('/'));
        } else {
            $modelLogin = new ModelLogin();
            $cekUserLogin = $modelLogin->find($email);
            $dataset = $modelLogin->where('email', $email)->first();
            if ($dataset == null) {
                $sessError = [
                    'errEmail' => 'maaf email tidak terdaftar',
                ];
                session()->setFlashdata($sessError);

                return redirect()->to(site_url('Home/index'));
            } else {
                $passUser = $dataset['password'];
                if ($pass == $passUser) {
                    $idlevel = $dataset['userlevelid'];

                    if ($idlevel == '2') {
                        $simpan_session = [
                            'userid' => $dataset['userid'],
                            'email' => $email,
                            'nama_user' => $dataset['nama_user'],
                            'idlevel' => $idlevel,
                            'password' => $dataset['password'],
                            'logged_in'     => TRUE
                        ];
                        session()->set($simpan_session);

                        session()->setFlashdata('login', 'Selamat Anda Berhasil Login');
                        return redirect()->to('/menuadmin/index');
                    } else {
                        $simpan_session = [
                            'userid' => $dataset['userid'],
                            'email' => $email,
                            'nama_user' => $dataset['nama_user'],
                            'idlevel' => $idlevel,
                            'password' => $dataset['password'],
                            'logged_in'     => TRUE
                        ];
                        session()->set($simpan_session);
                        $data = [
                            'title' => 'Wisatawan',
                            'profil' => $dataset['nama_user']
                        ];
                        session()->setFlashdata('login', 'Selamat Anda Berhasil Login');
                        return redirect()->to('/menuatasan/index');
                    }
                } else {
                    $sessError = [
                        'errPassword' => 'Password anda salah',
                    ];
                    session()->setFlashdata($sessError);

                    return redirect()->to(site_url('Home/index'));
                }
            }
        }
    }

    public function logout()
    {
        //hancurkan session 
        //balikan ke halaman login
        session()->setFlashdata('logout', 'Berhasil Logout');
        session()->destroy();
        return redirect()->to(site_url('/'));
    }
}
