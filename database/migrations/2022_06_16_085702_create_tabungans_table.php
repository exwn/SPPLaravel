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
        Schema::create('tabungan', function (Blueprint $table) {
            $table->increments('id');
            $table->double('jumlah');
            $table->date('date_in');
            $table->date('date_out');
            $table->text('keterangan')->nullable;
            $table->unsignedInteger('user_id')->unique()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('spp_tabungan', function (Blueprint $table) {
            $table->increments('id');
            $table->double('jumlah');
            $table->boolean('is_lunas')->default(0);
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
        Schema::dropIfExists('tabungan');
    }
};
