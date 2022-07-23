<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelajar extends Model
{
    use HasFactory;
    protected $table = 'pelajar';
    protected $guarded = [];
    protected $appends = ['jurusan_name', 'spp_kelas', 'spp_tagihan'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'id');
    }
    public function spp()
    {
        return $this->belongsTo(Spp::class, 'kelas_id', 'id');
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
