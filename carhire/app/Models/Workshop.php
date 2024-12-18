<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;
    protected $fillable = ['workshop_name','workshop_address','organizer_email','workshop_type','organizer_name','organizer_contact','added_by','is_deleted','is_active'];
    protected $table = 'workshop';
}
