<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    use HasFactory;

    protected $table = "pinjam";
    protected $primaryKey = "id";
    protected $fillable = ['id', 'no_pinjam', 'nama_pinjam', 'judul_buku', 'tanggal_pinjam', 'tanggal_kembali', 'submit_by'];
}
