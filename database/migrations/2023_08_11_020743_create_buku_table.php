<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('kode_buku', 255);
            $table->string('judul', 255);
            $table->text('deskripsi');
            $table->string('pengarang', 255);
            $table->string('penerbit', 255);
            $table->date('tahunTerbit');
            $table->string('gambar', 255);
            $table->integer('jmlhHalaman');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buku');
    }
}
