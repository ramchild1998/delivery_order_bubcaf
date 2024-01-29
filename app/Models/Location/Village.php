<?php

namespace App\Models\Location;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location\Subdistrict;
use App\Models\Master\Office;


class Village extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $table = "village";

    public function office()
    {
        return $this->hasOne(\App\Models\Master\Office::class);
    }

    public function subdistrict()
    {
        return $this->belongsTo(Subdistrict::class);
    }

}
