<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;
    protected $fillable = ['vehicle_reg_id','owner_id','insurance_company_id','bsb','policy_number','insurance_premium','ins_prem_direct_debit','insurance_start_date','insurance_end_date','payment_method_id','account_no','account_name','four_digit','bsb','added_by','is_deleted','is_active'];
    protected $table = 'insurance';
}
