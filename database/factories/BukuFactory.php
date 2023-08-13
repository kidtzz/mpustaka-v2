<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class
BukuFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * 
   * @return array
   */



  public function definition()
  {
    return [
      'deskripsi' => $this->faker->paragraph(2, true),
      'pengarang' => Str::random(10),
      'penerbit' => Str::random(10),
      'kode_buku' => 'BK' . random_int(100, 500),
      'judul' => 'Buku-' . Str::random(5),
      'tahunTerbit' => Carbon::now(),
      'jmlhHalaman' => random_int(100, 500),
      'gambar' => Str::random(10),
    ];
  }
}
