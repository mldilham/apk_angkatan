<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Angkatan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $anggotas = Anggota::with('angkatan')->latest()->paginate(10);
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
            'nama' => 'required|string|max:100',
            'sekolah' => 'required|string|max:150',
            'asal' => 'required|string|max:150',
            'kesan' => 'required|string',
            'pesan' => 'required|string',
            'angkatan_id' => 'required|exists:angkatans,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
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
        $anggota = Anggota::with('angkatan')->findOrFail($id);
        return view('admin.anggota.show', compact('anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $anggota = Anggota::findOrFail($id);
        $angkatans = Angkatan::all();
        return view('admin.anggota.edit', compact('anggota','angkatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $anggota = Anggota::findOrFail($id);
        $request->validate([
            'nama'         => 'required|string|max:100',
            'sekolah'      => 'required|string|max:150',
            'asal'         => 'required|string|max:150',
            'kesan'        => 'required|string',
            'pesan'        => 'required|string',
            'angkatan_id'  => 'required|exists:angkatans,id',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if($request->hasFile('foto')){
            if($anggota->foto){
                Storage::disk('public')->delete($anggota->foto);
            }
            $anggota->foto = $request->file('foto')->store('anggota','public');
        }

        $anggota->update([
            'nama' => $request->nama,
            'sekolah' => $request->sekolah,
            'asal' => $request->asal,
            'kesan' => $request->kesan,
            'pesan' => $request->pesan,
            'angkatan_id' => $request->angkatan_id,
            'foto' => $anggota->foto,
        ]);

        return redirect()->route('anggota.index')->with('success','Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        if ($anggota->foto) {
            Storage::disk('public')->delete($anggota->foto);
        }
        $anggota->delete();
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus');
    }
}
