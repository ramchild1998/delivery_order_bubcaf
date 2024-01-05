<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $table = "subdistrict";

    public function office()
    {
        return $this->hasOne(\App\Models\Master\Office::class);
    }

}
