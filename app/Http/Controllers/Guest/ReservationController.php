<?php

namespace App\Http\Controllers\Guest;

use App\Models\Booking;
use App\Models\DetailBooking;
use App\Models\Facility;
use App\Models\TypeRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Toastr;

class ReservationController extends Controller
{

    public function room(Request $request)
    {
        if ($request->id != "") {
            $data = TypeRoom::where('id', $request->id)->first();
            $access = $data->facilities()->pluck('facilities.id')->toArray();
            return view('guest.room.show')
                ->with('facilites', Facility::all())
                ->with('access', $access)
                ->with('item', $data);
        } else {
            $type_room = TypeRoom::all();
            return view('guest.room.index')
                ->with('data', $type_room);
        }
    }

    public function book(Request $request)
    {
        if ($request->room != "") {
            $data = TypeRoom::where('id', $request->room)->first();
            return view('guest.book.form')
                ->with('item', $data);
        } else {
            $count = Booking::where('users_id', Auth::id())
                ->where('status', '1')
                ->count();
            if ($count > 0){
                $data = Booking::where('users_id', Auth::id())
                    ->where('status', '1')
                    ->first();
                return view('guest.book.index')
                    ->with('data', $data);
            }else{
                return view('guest.book.not-found');
            }
        }
    }

    public function store(Request $request)
    {
        $cek = Booking::where('users_id', Auth::id())
            ->where('status', '1')
            ->exists();
        if (!$cek) {
            //Belum pernah booking
            $book = new Booking();
            $book->code_booking = 'B-' . Auth::id() . date('md');
            $book->name = '';
            $book->phone = '';
            $book->email = '';
            $book->total_price = $request->total_price;
            $book->users_id = Auth::id();
            $book->status = '1';
            $book->save();

        } else {
            $book = Booking::where('users_id', Auth::id())
                ->where('status', '1')
                ->first();
        }

        $data = array(
            'bookings_id' => $book->id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'night' => $request->night,
            'children' => 0,
            'type_rooms_id' => $request->type_rooms_id,
            'rooms_id' => $request->rooms_id,
            'price' => $request->total_price,
        );

        if (DetailBooking::create($data)) Toastr::success('Penambahan booking kamar berhasil', 'Success');
        return redirect()->route('guest.book');
    }

    public function edit($id)
    {
        $data = DetailBooking::where('id', $id)->first();
        return view('guest.book.edit')
            ->with('item', $data);
    }

    public function update($id, Request $request)
    {
        $data = array(
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'night' => $request->night,
            'children' => 0,
            'price' => $request->total_price,
        );

        if (DetailBooking::where('id', $id)->update($data)) Toastr::success('Perubahan booking kamar berhasil', 'Success');
        return redirect()->route('guest.book');
    }

    public function destroy($id)
    {
        if (DetailBooking::where('id', $id)->delete()) Toastr::success('Pemesanan berhasil dihapus', 'Success');
        return redirect()->route('guest.book');
    }

    public function continue_payment(Request $request)
    {
        $data = Booking::where('users_id', Auth::id())
            ->where('status', '1')
            ->first();
        $total_price = $data->detail_bookings->sum('price');
        $data->total_price = $total_price;
        $data->status = '2';
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->save();

        return redirect()->route('guest.pay.index');
    }

}
