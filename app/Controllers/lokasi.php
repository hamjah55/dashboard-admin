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
                'rules' => 'required|uploaded[geojson_file]|ext_in[geojson_file,geojson]',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                    'uploaded' => '{field} Harus diupload',
                    'ext_in'   => '{field} Harus berupa file .geojson'
                ]
            ],
        ])) {
            // Logika untuk membuat folder jika belum ada
            $folderPath = 'uploads/geojson';
            
            // Cek apakah folder ada, jika tidak ada, buat folder
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0777, true); // Membuat folder dengan permission 0777 dan membuat folder induk jika perlu
            }

            // Proses upload file GeoJSON
            $geojson = $this->request->getFile('geojson_file');
            $geojsonName = $geojson->getRandomName();

            // Pindahkan file ke folder uploads/geojson
            $geojson->move($folderPath, $geojsonName);

            // Data yang akan disimpan ke database
            $data = [
                'nama_lokasi' => $this->request->getPost('nama_lokasi'),
                'latitude'    => $this->request->getPost('latitude'),
                'longitude'   => $this->request->getPost('longitude'),
                'geojson_file'=> $geojsonName,
            ];

            // Simpan data ke database
            $this->ModelLokasi->insertData($data);

            // Redirect dengan pesan sukses
            return redirect()->to('lokasi/inputlokasi')->with('success', 'Data berhasil disimpan!');
        } else {
            // Jika tidak lolos validasi
            return redirect()->to('lokasi/inputlokasi')->withInput()->with('errors', $this->validator->getErrors());
        }
    }
}
