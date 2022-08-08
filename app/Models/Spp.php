<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    // use SoftDeletes;
    protected $table = 'spp';
    protected $guarded = [];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'spp_id', 'id');
    }
    public function user()
    {
        return $this->hasMany(User::class, 'kelas_id', 'id');
    }
}
