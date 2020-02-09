<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use App\Models\TypeRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Toastr;

class NewBookingController extends Controller
{
    public function index(Request $request)
    {
        $data = Booking::where('status', '2')
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('admin.new-booking.index')->with('data', $data);
    }

    public function show($id)
    {
        $data = Booking::where('id', $id)->first();
        return view('admin.new-booking.show')->with('data', $data);
    }

    public function update(Request $request, $id)
    {
        //method konfirmasi pemesanan maupun pembatalan
        $data = Booking::findOrFail($id);
        if ($data->fill($request->all())->save()) {
            if ($request->status = 0) Toastr::success('Pemesanan berhasil di batalkan', 'Success');
            else Toastr::success('Pemesanan berhasil di konfirmasi', 'Success');
        }
        return redirect()->route('admin.new-booking.index');

    }


}
