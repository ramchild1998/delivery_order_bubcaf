<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Master\Kurir;
use App\Models\Master\Office;
use App\Models\Master\Vendor;
use App\Models\Setting\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'type',
        'vendor_id',
        'office_id',
        'contact_number',
        'role_id',
        'password',
        'device_name',
        'is_active',
        'is_logged_in',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function kurir() {
        return $this->hasOne(Kurir::class);
    }

    public function role() {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function vendor() {
        return $this->belongsTo(Vendor::class,'vendor_id');
    }

    public function office() {
        return $this->belongsTo(Office::class,'office_id');
    }
    

}
