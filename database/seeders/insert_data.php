<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\buku;
use App\Models\Kembali;
use App\Models\Pinjam;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class insert_data extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //
    buku::factory(50)->create();
    buku::create([
      'deskripsi' => Str::random(10),
      'pengarang' => Str::random(10),
      'penerbit' => Str::random(10),
      'kode_buku' => 'BK' . random_int(100, 500),
      'judul' => 'Buku-' . Str::random(5),
      'tahunTerbit' => Carbon::now(),
      'jmlhHalaman' => random_int(100, 500),
      'gambar' => Str::random(10),
    ]);

    // berita::factory(50)->create();
    User::truncate();
    User::create([
      'name' => 'Admin Mpustaka',
      'email' => 'admin@gmail.com',
      'level' => 1,
      'password' => bcrypt('1'),
      'remember_token' => Str::random(60),
    ]);

    // anggota::create([
    //   'name' => 'Admin-' . Str::random(2),
    //   'email' => Str::random(5) . '@gmail.com',
    // ]);

    Berita::create([
      'judul' => 'Berita tentang' . Str::random(5),
      'deskripsi' => 'Admin',
      'kategori' => "kegiatan",
      'gambar' => "test",
      'user' => "admin",
      'kategori' => Str::random(5),
    ]);

    Pinjam::create([
      'no_pinjam' => 'PIN-' . Str::random(5),
      'nama_pinjam' => Str::random(5),
      'judul_buku' => Str::random(10),
      'tanggal_kembali' => Carbon::now(),
      'tanggal_pinjam' => Carbon::now(),
      'submit_by' => 'Admin',
    ]);

    Kembali::create([
      'no_kembali' => 'KEM-' . Str::random(5),
      'nama_pinjam' => Str::random(5),
      'judul_buku' => Str::random(10),
      'tanggal_kembali' => Carbon::now(),
      'tanggal_pinjam' => Carbon::now(),
      'status' => 'InActive',
      'submit_by' => 'Admin',
    ]);
  }
}
