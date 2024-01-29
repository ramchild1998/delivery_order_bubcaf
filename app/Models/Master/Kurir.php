<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Vendor;
use App\Models\Master\Office;
use App\Models\Location\City;
use App\Models\Location\Province;
use App\Models\Location\Village;
use App\Models\Location\Subdistrict;
use App\Models\JobOrder\Pickup;

class Kurir extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'id',
        'nik',
        'name',
        'no_hp',
        'address',
        'zip_code',
        'province_id',
        'city_id',
        'subdistrict_id',
        'village_id',
        'foto',
        'vendor_id',
        'office_id',
        'plat_number',
        'is_active',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];


    public function vendor() {
        return $this->belongsTo(Vendor::class,'vendor_id');
    }

    public function office() {
        return $this->belongsTo(Office::class,'office_id');
    }
    public function city()
    {
        return $this->belongsTo(\App\Models\Location\City::class);
    }
    public function device()
    {
        return $this->hasMany(\App\Models\Utilities\Device::class);
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

    public function pickup()
    {
        return $this->hasMany(Pickup::class);
    }

    

}
