<?php

namespace App\Controllers;

use App\Models\ModelLokasi;

class Lokasi extends BaseController
{
    public function __construct()
    {
      $this->ModelLokasi = new ModelLokasi();
    }
    public function index()
    {
        $data = [
            'judul' => 'Data Lokasi',
            'page'  => 'data_lokasi',
        ];
        return view('template', $data);
    }

    public function inputLokasi()
    {
        $data = [
            'judul' => 'Input Lokasi',
            'page'  => 'lokasi/input_lokasi',
        ];
        return view('template', $data);
    }

    public function insertData()
{
    if ($this->validate([
        'nama_lokasi' => [
            'label' => 'Nama Lokasi',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Tidak Boleh Kosong '
            ]
        ],
        'latitude' => [
            'label' => 'latitude',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Tidak Boleh Kosong '
            ]
        ],
        'longitude' => [
            'label' => 'longitude',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Tidak Boleh Kosong '
            ]
        ],
        'geojson_file' => [
            'label' => 'geojson',
            'rules' => 'required',
            'errors' => [
                'required' => '{field} Tidak Boleh Kosong'
            ]
        ],
    ])) {
        // Jika lolos validasi
        $data = [
            'nama_lokasi' => $this->request->getPost('nama_lokasi'),
            'latitude'    => $this->request->getPost('latitude'),
            'longitude'   => $this->request->getPost('longitude'),
            'Geojson'     => $this->request->getPost('geojson_file') // diasumsikan input dari textarea
        ];
        $this->ModelLokasi->insertData($data);
        return redirect()->to('Lokasi/inputlokasi');
    } else {
        // Jika tidak lolos validasi
        return redirect()->to('Lokasi/inputlokasi')->withInput();
    }
}
        }
 