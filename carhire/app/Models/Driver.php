<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Driver extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name', 'last_name', 'email', 'contact', 'driver_license_no', 'driver_license_state', 'license_expiry_date', 'dob', 'street', 'country', 'suburb', 'state', 'postal_code', 'is_active', 'is_deleted', 'added_by', 'driver_image', 'passport_image', 'license_back_image', 'license_front_image', 'ezi_debt', 'other_document', 'p_m_value', 'p_m_image', 'user_id'
    ];
    protected $primaryKey = 'driver_id';
    protected $table = 'driver';

    public function booking()
    {
        return $this->hasMany(Booking::class, 'driver_id', 'driver_id');
    }

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class, 'driver_id', 'driver_id');
    }
}
