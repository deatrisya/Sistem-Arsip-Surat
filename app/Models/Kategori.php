<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategoris'; // menentukan nama tabel sesuai di database
    protected $fillable = [ // memastikan kolom yang wajib diisi
        'nama_kategori',
        'keterangan'
    ];

    public function arsip()
    {
        return $this->hasMany(Arsip::class); // 1 kategori memiliki banyak arsip one to many
    }
}
