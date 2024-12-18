<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'user_id',
        'fine_id',
        'comment',
        'created_at',
        'updated_at',
    ];

    protected $primaryKey = 'comment_id';
    protected $table = 'comment';

    // Relationships
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'booking_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function fine()
    {
        return $this->belongsTo(Fine::class, 'fine_id', 'fine_id');
    }
}