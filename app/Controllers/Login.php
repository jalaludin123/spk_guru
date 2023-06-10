<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Login extends BaseController
{

    public function __construct()
    {
        $this->admin = new AdminModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Login',
            'sub'       => 'Halaman Login',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/login', $data);
    }

    public function register()
    {
        $data = [
            'title'     => 'Register',
            'sub'       => 'Halaman Register',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/register', $data);
    }

    public function insert()
    {
        $validasi = $this->validate([
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ],
            'username' => [
                'label' => 'Username',
                'rules' => 'required|is_unique[user.username]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Digunakan'
                ]
            ],
            'password' => [
                'label' => 'Passowrd',
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'min_length' => '{field} Minimal 6 Karakter'
                ]
            ],
            'confirm' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'matches'  => '{field} Tidak Sama'
                ]
            ],
            'level' => [
                'label' => 'Level',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ]
        ]);

        if (!$validasi) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        } else {
            $data = [
                'nama' => $this->request->getPost('nama'),
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'level' => $this->request->getPost('level';)
            ];

            $this->admin->insert($data);
            session()->setFlashdata('success', 'Data Berhasil Ditambahkan');
            return redirect()->to(base_url('login'));
        }
    }

    public function proses()
    {
        $valid = $this->validate([
            'username' => [
                'label'         => 'Username',
                'rules'         => 'required',
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ],
            'password'          => [
                'label'         => 'Password',
                'rules'         => 'required',
                'errors'        => [
                    'required'  => '{field} Tidak Boleh Kosong'
                ]
            ]
        ]);
        if (!$valid) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $admin = $this->admin->where(['username' => $username])->first();
        if ($admin) {
            if (password_verify($password, $admin['password'])) {
                $data = [
                    'isLogin'   => true,
                    'id_user'   => $admin['id_user'],
                    'nama'      => $admin['nama'],
                    'username'  => $admin['username'],
                    'level'     => $admin['level'],
                ];
                session()->set($data);
                session()->setFlashdata('success', 'Berhasil Login');
                return redirect()->to(base_url('admin/home'));
            } else {
                session()->setFlashdata('error1', 'Password Salah');
                return redirect()->to(base_url('login'));
            }
        } else {
            session()->setFlashdata('error2', 'Akun Tidak Ditemukan');
            return redirect()->to(base_url('login'));
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}