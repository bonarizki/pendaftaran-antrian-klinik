<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pasien extends Model
{
    use HasFactory,Uuids,SoftDeletes;

    protected $fillable = [];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
