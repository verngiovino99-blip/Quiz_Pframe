<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    // Mengizinkan mass assignment (create/update)
    protected $guarded = ['id'];

    // Mendefinisikan relasi ke tabel kategoris
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}