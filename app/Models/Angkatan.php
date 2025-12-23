<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Angkatan extends Model
{
    //
    protected $fillable = [
        'nama_angkatan','tahun','logo','motto','filosofi'
    ];

    public function anggotas()
    {
        return $this->hasMany(Anggota::class);
    }
}
