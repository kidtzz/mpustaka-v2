<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kembali extends Model
{
    use HasFactory;
    protected $table = "kembali";
    protected $primaryKey = "id";
    protected $fillable = ['id', 'no_kembali', 'nama_pinjam', 'judul_buku', 'tanggal_pinjam', 'tanggal_kembali', 'submit_by', 'status', 'created_at'];
}
