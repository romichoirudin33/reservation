<?php

namespace App\Models;

use App\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeRoom extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price'
    ];

    protected $dates = ['deleted_at'];

    public function room_images()
    {
        return $this->hasMany(RoomImage::class, 'type_rooms_id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'type_rooms_id');
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'facility_rooms', 'type_rooms_id', 'facilities_id');
    }
}
