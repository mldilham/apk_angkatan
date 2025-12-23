<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    //
    protected $fillable = [
        'nama','sekolah','asal','kesan','pesan','foto','angkatan_id'
    ];

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class);
    }
}
