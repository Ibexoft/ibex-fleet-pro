<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
     protected $fillable = [
        'start_date','end_date','vehicle_reg_id','driver_id','amount','comments','name','phone','is_active','bond_held','contract_image','ezidebit_image','insurance_declaration_image','handover_checklist_image','is_deleted','added_by','actual_return_date','date_status','bond_amount','status'
    ];
    protected $primaryKey = 'booking_id';
    protected $table = 'booking';

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_reg_id', 'vehicle_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'driver_id');
    }

    public function customer()
{
    return $this->belongsTo(Customer::class, 'bond_held', 'customer_id');
}
}
