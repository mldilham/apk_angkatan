<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AngkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $angkatans = Angkatan::withCount('anggotas')->latest()->paginate(10);
        return view('admin.angkatan.index', compact('angkatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.angkatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_angkatan' => 'required|string|max:100',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'motto' => 'required|string|max:255',
            'filosofi' => 'required|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('angkatan', 'public');
        }

        Angkatan::create([
            'nama_angkatan' => $request->nama_angkatan,
            'tahun' => $request->tahun,
            'motto' => $request->motto,
            'filosofi' => $request->filosofi,
            'logo' => $logoPath
        ]);

        return redirect()->route('angkatan.index')->with('success', 'Angkatan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $angkatan = Angkatan::with('anggotas')->findOrFail($id);
        return view('admin.angkatan.show', compact('angkatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $angkatan = Angkatan::findOrFail($id);
        return view('admin.angkatan.edit', compact('angkatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $angkatan = Angkatan::findOrFail($id);
        $request->validate([
            'nama_angkatan' => 'required|string|max:100',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 10),
            'motto' => 'required|string|max:255',
            'filosofi' => 'required|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            if ($angkatan->logo) {
                Storage::disk('public')->delete($angkatan->logo);
            }
            $angkatan->logo = $request->file('logo')->store('angkatan', 'public');
        }

        $angkatan->update([
            'nama_angkatan' => $request->nama_angkatan,
            'tahun' => $request->tahun,
            'motto' => $request->motto,
            'filosofi' => $request->filosofi,
            'logo' => $angkatan->logo,
        ]);

        return redirect()->route('angkatan.index')->with('success', 'Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $angkatan = Angkatan::findOrFail($id);
        if ($angkatan->logo) {
            Storage::disk('public')->delete($angkatan->logo);
        }
        $angkatan->delete();
        return redirect()->route('angkatan.index')->with('success', 'Angkatan berhasil dihapus');
    }
}
