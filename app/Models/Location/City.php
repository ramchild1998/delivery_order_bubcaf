<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $table = "city";

    public function office()
    {
        return $this->hasOne(\App\Models\Master\Office::class);
    }
}
