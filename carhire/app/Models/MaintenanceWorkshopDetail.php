<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceWorkshopDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'clock_on', 'clock_off', 'invoice'
    ];

    public function getMaintenanceWorkshopItems(){
        return $this->hasMany(MaintenanceWorkshopItem::class,'maintenance_workshop_id','id');
    }

    public function getWorkshops(){
        return $this->belongsTo(Workshop::class,'workshop_id','workshop_id');
    }
}
