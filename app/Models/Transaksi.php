<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use SoftDeletes;
    protected $table = 'transaksi';
    protected $guarded = [];


    public function spp()
    {
        return $this->belongsTo(Spp::class, 'spp_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function getJurusanNameAttribute()
    {
        return "{$this->jurusan->name}";
    }
    public function getSppKelasAttribute()
    {
        return "{$this->spp->id}";
    }
    public function getSppTagihanAttribute()
    {
        return "{$this->spp->total_tagihan}";
    }
}
