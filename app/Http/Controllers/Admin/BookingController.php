<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function index()
    {
        $data = Booking::where('status', '3')
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('admin.booking.index')->with('data', $data);
    }

    public function show($id)
    {
        $data = Booking::where('id', $id)->first();
        return view('admin.booking.show')->with('data', $data);
    }
}
