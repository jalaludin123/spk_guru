<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\BobotModel;
use App\Models\ModelGuru;
use App\Models\PenilaianModel;

class User extends BaseController
{
    public function __construct()
    {
        $this->user = new AdminModel();
        $this->guru = new ModelGuru();
        $this->bobot = new BobotModel();
        $this->nilai = new PenilaianModel();
    }

    public function index()
    {
        $id_admin = session()->get('id_user');
        $data  = [
            'title'     => 'Data User',
            'sub'       => 'Halaman user',
            'user'      => $this->user->findAll(),
            'admin'     => $this->user->getAdmin($id_admin)
        ];

        return view('admin/user', $data);
    }

    public function addUser()
    {
        $id_admin = session()->get('id_user');
        $data  = [
            'title'     => 'Add Data User',
            'sub'       => 'Halaman user',
            'validation' =>  \Config\Services::validation(),
            'admin'     => $this->user->getAdmin($id_admin)
        ];

        return view('admin/adduser', $data);
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
                'label' => 'Password',
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'min_length' => '{field} Minimal 6 Karakter'
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
                'level' => $this->request->getPost('level')
            ];

            $this->user->insert($data);
            session()->setFlashdata('success', 'Data Berhasil DItambahkan');
            return redirect()->to(base_url('admin/user'));
        }
    }

    public function edit($id_user)
    {
        $id_admin = session()->get('id_user');
        $data = [
            'title'     => 'Edit Data User',
            'sub'       => 'Halaman user',
            'validation' =>  \Config\Services::validation(),
            'user'       => $this->user->getAdmin($id_user),
            'admin'     => $this->user->getAdmin($id_admin)
        ];
        return view('admin/edituser', $data);
    }

    public function update($id_user)
    {
        $dataLama = $this->user->getAdmin($this->request->getVar('user'));
        if ($dataLama['username'] == $this->request->getPost('username')) {
            $rule_username = 'required';
        } else {
            $rule_username = 'required|is_unique[user.username]';
        }

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
                'rules' => $rule_username,
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'is_unique' => '{field} Sudah Digunakan'
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
        } else if ($this->request->getPost('password') != '') {
            $data = [
                'id_user'   => $id_user,
                'nama' => $this->request->getPost('nama'),
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'level' => $this->request->getPost('level')
            ];

            $this->user->update($id_user, $data);
            session()->setFlashdata('success', 'Data Berhasil diedit');
            return redirect()->to(base_url('admin/user'));
        } else {
            $data = [
                'id_user'   => $id_user,
                'nama' => $this->request->getPost('nama'),
                'username' => $this->request->getPost('username'),
                // 'password' => $this->request->getPost('password'),
                'level' => $this->request->getPost('level')
            ];

            $this->user->update($id_user, $data);
            session()->setFlashdata('success', 'Data Berhasil diedit');
            return redirect()->to(base_url('admin/user'));
        }
    }

    public function hapus($id_user)
    {
        $user = $this->user->getAdmin($id_user);

        if ($user) {
            $this->user->delete($id_user);
            session()->setFlashdata('success', 'Data Berhasil Dihapus');
            return redirect()->to('admin/user');
        }
    }
}