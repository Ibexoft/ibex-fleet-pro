<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceCompany extends Model
{
    use HasFactory;
    protected $fillable = ['ic_id','icompany_name','icompany_reg_no','icompany_address','is_deleted'];
    protected $table = 'insurance_company';
}
