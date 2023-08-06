<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apoteker extends Model
{
    use HasFactory,Uuids,SoftDeletes;

    protected $guarded = [];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
}
