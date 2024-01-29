<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Office;

class Vendor extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'name',
        'pic_name',
        'pic_contact_num',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function offices()
    {
        return $this->hasMany(Office::class);
    }

}
