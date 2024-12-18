<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceTypeDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'labour'
    ];

    public function maintenance_type(){
        return $this->belongsTo(Setting::class, 'maintenance_type_id', 'maintenance_type_id');
    }

    public function maintenance_type_item(){
        return $this->hasMany(MaintenanceTypeItem::class);
    }
}
