<?php

namespace App\Http\Controllers\Guest;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Toastr;

class PaymentController extends Controller
{
    public function index()
    {
        $data = Booking::where('users_id', Auth::id())
            ->where('status', '2')
            ->first();
        if ($data->count() > 0){
            return view('guest.pay.index')
                ->with('data', $data);
        }else{
            abort(404);
        }
    }
}
