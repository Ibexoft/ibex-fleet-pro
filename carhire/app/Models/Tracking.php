<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;
     protected $fillable = [
        'tracker_name','tracker_imei','cell_provider','mobile_no','iccid_no','vehicle_id','allocated_to','is_active','is_deleted','added_by'
    ];
    protected $table = 'tracking';
}
