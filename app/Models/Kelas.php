<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    // use SoftDeletes;
    protected $table = 'kelas';

    protected $fillable = [
        'name'
        // 'periode'
    ];

    public function periode()
    {
        return $this->hasOne(Periode::class, 'id', 'periode_id');
    }
}
