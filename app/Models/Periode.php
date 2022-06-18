<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;
    protected $table = 'periode';
    protected $guarded = [];

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'periode_id', 'id');
    }
}
