<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('spp', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('name');
        //     $table->double('jumlah');
        //     $table->timestamps();
        //     $table->softDeletes();
        // });

        Schema::create('spp', function (Blueprint $table) {
            $table->id();
            $table->year('tahun_ajaran');
            $table->string('kelas');
            $table->double('total_tagihan');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('pelajar_spp', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pelajar_id')->nullable();
            $table->unsignedInteger('spp_id')->nullable();
            $table->string('bulan');
            $table->double('jumlah_dibayarkan');
            $table->double('tunggakan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spp');
    }
};
