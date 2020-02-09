<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBooking extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'bookings_id',
        'check_in',
        'check_out',
        'night',
        'children',
        'type_rooms_id',
        'rooms_id',
        'price'
    ];

    public function type_room()
    {
        return $this->belongsTo(TypeRoom::class, 'type_rooms_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'rooms_id');
    }
}
