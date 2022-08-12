<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\ModelGuru;

class Guru extends BaseController
{

    public function __construct()
    {
        $this->guru = new ModelGuru();
        $this->admin = new AdminModel();
    }

    public function index()
    {
        $id_user = session()->get('id_user');
        $data = [
            'title' => 'Data Guru',
            'sub'  => 'Halaman Guru',
            'guru' => $this->guru->findAll(),
            'admin'         => $this->admin->getAdmin($id_user)
        ];

        return view('admin/guru', $data);
    }

    public function addGuru()
    {
        // session();
        $id_user = session()->get('id_user');
        $data = [
            'title' => 'Tambah Data Guru',
            'sub'  => 'Halaman Guru',
            'validation' =>  \Config\Services::validation(),
            'admin'         => $this->admin->getAdmin($id_user)
        ];
        return view('admin/addGuru', $data);
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
            'jabatan' => [
                'label' => 'Jabatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ],
            'jk' => [
                'label' => 'Jenis Kelamin',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ],
            'pendidikan' => [
                'label' => 'Pendidikan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ],
            'kerja' => [
                'label' => 'Masa Kerja',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ],
            'tgl' => [
                'label' => 'Tanggal Lahir',
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
                'nama_guru' => $this->request->getPost('nama'),
                'jabatan' => $this->request->getPost('jabatan'),
                'pendidikan' => $this->request->getPost('pendidikan'),
                'kerja' => $this->request->getPost('kerja'),
                'jk' => $this->request->getPost('jk'),
                'tgl_lahir' => $this->request->getPost('tgl')
            ];

            $this->guru->insert($data);
            session()->setFlashdata('success', 'Data Berhasil DItambahkan');
            return redirect()->to(base_url('admin/guru'));
        }
    }

    public function edit($id_guru)
    {
        $id_user = session()->get('id_user');
        $data = [
            'title' => 'Edit Data Guru',
            'sub'  => 'Halaman Guru',
            'validation' =>  \Config\Services::validation(),
            'guru' => $this->guru->getData($id_guru),
            'admin'         => $this->admin->getAdmin($id_user)
        ];

        return view('admin/editGuru', $data);
    }

    public function update($id_guru)
    {

        $validasi = $this->validate([
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ],
            'jabatan' => [
                'label' => 'Jabatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ],
            'jk' => [
                'label' => 'Jenis Kelamin',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ],
            'pendidikan' => [
                'label' => 'Pendidikan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ],
            'kerja' => [
                'label' => 'Masa Kerja',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ],
            'tgl' => [
                'label' => 'Tanggal Lahir',
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
                'id_guru' => $id_guru,
                'nama' => $this->request->getPost('nama'),
                'jabatan' => $this->request->getPost('jabatan'),
                'pendidikan' => $this->request->getPost('pendidikan'),
                'kerja' => $this->request->getPost('kerja'),
                'jk' => $this->request->getPost('jk'),
                'tgl_lahir' => $this->request->getPost('tgl'),
            ];
            $this->guru->update($id_guru, $data);
            session()->setFlashdata('success', 'Data Berhasil diedit');
            return redirect()->to(base_url('admin/guru'));
        }
    }

    public function hapus($id_guru)
    {
        $guru = $this->guru->getData($id_guru);

        if ($guru) {
            $this->guru->delete($id_guru);
            session()->setFlashdata('success', 'Data Berhasil Dihapus');
            return redirect()->to('admin/guru');
        }
    }
}