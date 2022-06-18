<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use SoftDeletes;
    protected $table = 'spp_tabungan';
    protected $fillable = [
        'jumlah'
    ];
}
