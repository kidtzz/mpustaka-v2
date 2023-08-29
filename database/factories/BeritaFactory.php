<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BeritaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            //
            'judul' => 'Berita tentang' . Str::random(5),
            'deskripsi' => $this->faker->paragraph(2, true),
            'kategori' => 'kegiatan' . random_int(1, 10),
            'gambar' => "Fake" . random_int(1, 10) . ".jpg",
            'user' => "admin",
            'kategori' => Str::random(5),
        ];
    }
}
