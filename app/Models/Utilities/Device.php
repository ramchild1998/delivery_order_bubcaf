<?php

namespace App\Models\Utilities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Vendor;
use App\Models\Master\Office;
use App\Models\Location\City;
use App\Models\Location\Province;
use App\Models\Location\Village;
use App\Models\Location\Subdistrict;
class Device extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'kurir_id',
        'device_id',
        'merk',
        'type',
        'is_active',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];


    public function kurir()
    {
        return $this->belongsTo(\App\Models\Master\Kurir::class);
    }

}
