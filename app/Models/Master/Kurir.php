<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurir extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function city()
    {
        return $this->belongsTo(\App\Models\Location\City::class);
    }

    public function province()
    {
        return $this->belongsTo(\App\Models\Location\Province::class);
    }

    public function subdistrict()
    {
        return $this->belongsTo(\App\Models\Location\Subdistrict::class);
    }

    public function village()
    {
        return $this->belongsTo(\App\Models\Location\village::class);
    }

}
