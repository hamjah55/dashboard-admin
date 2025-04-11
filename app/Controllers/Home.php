<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'page' => 'halaman_dashboard',
        ];
        return view('template', $data);
    }

    public function viewMap()
    {
        $data = [
            'judul' => 'View Map',
            'page' => 'halaman_view_map',
        ];
        return view('template', $data);
    }

    public function baseMap()
    {
        $data = [
            'judul' => 'Base Map',
            'page' => 'halaman_basemap',
        ];
        return view('template', $data);
    }

    public function Marker()
    {
        $data = [
            'judul' => 'Marker',
            'page' => 'halaman_marker',
        ];
        return view('template', $data);
    }
}
