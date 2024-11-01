<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingLab extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'facilities' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room_lab()
    {
        return $this->belongsTo(RoomLab::class);
    }
}
