<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLokasi extends Model
{
    protected $table = 'd_lokasi';
    protected $primaryKey = 'int';
    protected $allowedFields = ['nama_lokasi', 'latitude', 'longitude', 'geojson_file'];

    public function insertData($data)
    {
        return $this->insert($data);
    }
}