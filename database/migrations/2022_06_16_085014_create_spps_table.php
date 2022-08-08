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
        Schema::create('spp', function (Blueprint $table) {
            $table->id();
            $table->string('kelas');
            $table->year('tahun_ajaran');
            $table->double('total_tagihan');
            $table->timestamps();
        });
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('users_id')->nullable();
            $table->unsignedBigInteger('spp_id')->nullable();
            $table->string('bulan');
            $table->double('jumlah_dibayarkan');
            $table->double('tunggakan')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->text('keterangan')->nullable();
            $table->boolean('status')->default(0);
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
