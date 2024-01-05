<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'name',
        'vendor_id',
        'pic_contact_number',
        'address',
        'province_id',
        'city_id',
        'subdistrict_id',
        'village_id',
        'pic_contact_num',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $vendors = Vendor::where('name', 'like', '%' . $searchTerm . '%')
            ->orderBy('name', 'asc')
            ->get();

        return response()->json([
            'items' => $vendors
        ]);
    }

    public function vendors()
    {
        return $this->belongsTo(Vendor::class);
    }

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
