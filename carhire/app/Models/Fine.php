<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicle_reg_id','notice','notice_type','notice_type_details','due_date','amount','date_of_offence','date_process', 'status', 'comment','is_active','is_deleted','added_by','payable_id','payable_type'
    ];
    protected $casts = [
        'notice_type_details' => 'array', // Automatically cast JSON to array
    ];
    protected $primaryKey = 'fine_id';
    protected $table = 'fine';

    public function payable()
    {
        return $this->morphTo();
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class,'vehicle_reg_id','vehicle_id');
    }
}
