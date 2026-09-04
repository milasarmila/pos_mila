<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    // Tentukan nama tabel jika nama model Anda tunggal (Jenis) tapi tabelnya (jenis)
    protected $table = 'jenis'; 

    // WAJIB TAMBAHKAN BARIS INI UNTUK MENAMPUNG DATA DARI FORM
    protected $fillable = [
        'nama_jenis',
    ];
}
