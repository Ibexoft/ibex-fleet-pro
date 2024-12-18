<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkshopType extends Model
{
    use HasFactory;
    
    use HasFactory;
    protected $fillable = ['workshop_type_name','is_active','is_deleted'];
    protected $primaryKey = 'workshop_type_id';
    protected $table = 'workshop_type';
}

