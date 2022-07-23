<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use SoftDeletes;
    protected $table = 'pelajar_spp';
    protected $guarded = [];

    public function pelajar()
    {
        return $this->belongsTo(Pelajar::class, 'pelajar_id', 'id');
    }
    public function spp()
    {
        return $this->belongsTo(Spp::class, 'spp_id', 'id');
    }
}
