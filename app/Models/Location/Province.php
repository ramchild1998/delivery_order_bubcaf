<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $table = "province";

    public function office()
    {
        return $this->hasOne(\App\Models\Master\Office::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

}
