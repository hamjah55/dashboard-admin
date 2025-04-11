<?php

namespace App\Controllers;

use App\Models\ModelLokasi;

class Lokasi extends BaseController
{
    protected $ModelLokasi;

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
        // Validasi input
        if ($this->validate([
            'nama_lokasi' => [
                'label' => 'Nama Lokasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ],
            'latitude' => [
                'label' => 'Latitude',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ],
            'longitude' => [
                'label' => 'Longitude',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong'
                ]
            ],
            'geojson_file' => [
                'label' => 'GeoJSON',
                'rules' => 'uploaded[geojson_file]|ext_in[geojson_file,geojson]',
                'errors' => [
                    'uploaded' => '{field} Harus diupload',
                    'ext_in'   => '{field} Harus berupa file .geojson'
                ]
            ]
        ])) {
            // Simpan file
            $geojson = $this->request->getFile('geojson_file');
            $geojsonName = $geojson->getRandomName();
            $geojson->move('uploads/geojson/', $geojsonName); // pastikan folder ini ada

            // Data yang akan disimpan
            $data = [
                'nama_lokasi' => $this->request->getPost('nama_lokasi'),
                'latitude'    => $this->request->getPost('latitude'),
                'longitude'   => $this->request->getPost('longitude'),
                'geojson_file'=> $geojsonName,
            ];

            $this->ModelLokasi->insertData($data);
            return redirect()->to('lokasi/inputlokasi')->with('success', 'Data berhasil disimpan!');
        } else {
            // Jika tidak lolos validasi
            return redirect()->to('lokasi/inputlokasi')->withInput()->with('errors', $this->validator->getErrors());
        }
    }
}
