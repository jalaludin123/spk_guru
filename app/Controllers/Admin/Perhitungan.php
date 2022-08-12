<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\BobotModel;
use App\Models\PenilaianModel;

class Perhitungan extends BaseController
{
    public function __construct()
    {
        $this->nilai = new PenilaianModel();
        $this->bobot = new BobotModel();
        $this->user = new AdminModel();
    }

    public function index()
    {
        $id_admin = session()->get('id_user');
        $data = [
            'title'         => 'Perangkingan Dengan Metode Weighted Product',
            'sub'           => 'Halaman Bobot & Indikator',
            'mhs'         => $this->bobot->getData(),
            'nilai'         => $this->nilai->findAll(),
            'admin'     => $this->user->getAdmin($id_admin)
        ];

        return view('guru/hasilPerhitungan', $data);
    }
}