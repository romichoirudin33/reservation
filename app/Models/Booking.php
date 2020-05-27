<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'code_booking',
        'name',
        'phone',
        'email',
        'users_id', //pengunjung
        'total_price',
        'status'
    ];

    public function detail_bookings()
    {
        return $this->hasMany(DetailBooking::class, 'bookings_id');
    }

    public function guest()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function proof() //bukti
    {
        return $this->hasOne(Proof::class, 'bookings_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'bookings_id');
    }
}
