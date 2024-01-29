<?php

namespace App\Models\JobOrder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Kurir;

class PickupDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'desc',
        'pickup_id',
        'time_start',
        'time_end',
        'status',
    ];

    public $table = "pickup_detail";

    public function pickup()
    {
        return $this->belongsTo(\App\Models\JobOrder\Pickup::class);
    }
}
