<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Angkatan;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $anggotas = Anggota::with('angkatan')->latest()->get();
        return view('admin.anggota.index', compact('anggotas'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $angkatans = Angkatan::all();
        return view('admin.anggota.create', compact('angkatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama' => 'required',
            'sekolah' => 'required',
            'asal' => 'required',
            'kesan' => 'required',
            'pesan' => 'required',
            'angkatan_id' => 'required',
            'foto' => 'image|mimes:jpg,jpeg,png|max:2040'
        ]);

        $fotoPath = null;
        if($request->hasFile('foto')){
            $fotoPath = $request->file('foto')->store('anggota', 'public');
        }


        Anggota::create([
            'nama' =>$request->nama,
            'sekolah' =>$request->sekolah,
            'asal' =>$request->asal,
            'kesan' =>$request->kesan,
            'pesan' =>$request->pesan,
            'angkatan_id' =>$request->angkatan_id,
            'foto' =>$fotoPath
        ]);

        return redirect()->route('anggota.index')->with('success','Anggota Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        // $anggota = Anggota::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
