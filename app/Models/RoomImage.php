<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
    public $timestamps = false;

    protected $fillable = ['name_file', 'type_rooms_id'];
}
