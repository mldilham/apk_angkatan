<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Angkatan;
use App\Models\Anggota;
use App\Models\Galeri;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data angkatan pertama (atau bisa disesuaikan)
        $angkatan = Angkatan::first();

        // Ambil semua anggota
        $anggotas = Anggota::all();

        // Ambil semua galeri
        $galeris = Galeri::all();

        return view('home', compact('angkatan', 'anggotas', 'galeris'));
    }
}
