<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Setting;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maintenance extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['vehicle_reg_id','driver_id','comments','odo_meter','next_service','maintenance_date','paid_by','job_status','added_by','is_active'];
    protected $table = 'maintenance';

    public function getVehicle(){
        return $this->belongsTo(Vehicle::class,'vehicle_reg_id','vehicle_id');
    }

    public function getDriver(){
        return $this->belongsTo(Driver::class,'driver_id','driver_id');
    }

    public function getMaintenanceTypeDetails(){
        return $this->hasMany(MaintenanceTypeDetail::class,'maintenance_id','id');
    }

    public function getWorkshopDetails(){
        return $this->hasMany(MaintenanceWorkshopDetail::class,'maintenance_id','id');
    }
}
