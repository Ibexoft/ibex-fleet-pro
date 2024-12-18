<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = ['vehicle_id','driver_id','insurance_id','tracker_id','bond','held_by','advance','per_week','rate_changes','rego_due','coi_due','bhsl_due','return_date','biller_code','reference_no','vin','engin_number','comments','is_active','is_deleted'];
    protected $table = 'contract';
}
