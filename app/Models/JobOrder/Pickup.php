<?php

namespace App\Models\JobOrder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Kurir;

class PickUp extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'date_visit',
        'no_consumen',
        'name_consumen',
        'address',
        'zip_code',
        'no_hp',
        'is_active',
        'kurir_id',
        'status',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];
    public $table = "pickup";

    public function pickup_detail()
    {
        return $this->hasOne(\App\Models\JobOrder\PickupDetail::class);
    }

    public function kurir()
    {
        return $this->belongsTo(\App\Models\Master\Kurir::class);
    }
}
