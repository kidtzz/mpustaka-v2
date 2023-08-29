<?php

namespace App\Models;

use Database\Factories\BeritaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $table = "berita";
    protected $primaryKey = "id";
    protected $fillable = ['id', 'judul', 'kategori', 'deskripsi', 'gambar', 'user'];

    protected static function newFactory()
    {
        return BeritaFactory::new();
    }
}
