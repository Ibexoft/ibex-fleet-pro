<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    
    use HasFactory;
    protected $fillable = ['maintenance_type_name','maintenance_type_status','is_active','is_deleted'];
    protected $table = 'setting';
}

