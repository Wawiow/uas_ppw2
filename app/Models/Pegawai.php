<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{

    use SoftDeletes;

    protected $table = 'sedayuHS_543905_pegawai';

    protected $dates = ['deleted_at'];

    public function pegawai()
    {
        return $this->hasOne(Pekerjaan::class);
    }
}
