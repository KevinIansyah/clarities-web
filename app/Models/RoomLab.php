<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomLab extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function booking_labs()
    {
        return $this->hasMany(BookingLab::class);
    }
}
