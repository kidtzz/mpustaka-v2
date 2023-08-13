<?php

namespace App\Models;

use Database\Factories\BukuFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = "buku";
    protected $primaryKey = "id";
    protected $fillable = ['id', 'kode_buku', 'judul', 'deskripsi', 'pengarang', 'penerbit', 'jmlhHalaman', 'gambar', 'tahunTerbit'];

    /** @return SomeFancyFactory */
    protected static function newFactory()
    {
        return BukuFactory::new();
    }
}
