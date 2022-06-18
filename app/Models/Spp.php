<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    use SoftDeletes;
    protected $table = 'spp';
    protected $fillable = [
        'name',
        'jumlah'
    ];
}
