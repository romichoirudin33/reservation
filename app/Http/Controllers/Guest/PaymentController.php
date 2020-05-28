<?php

namespace App\Http\Controllers\Guest;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Toastr;
use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;

class PaymentController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        // Set midtrans configuration
        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function index()
    {
        $data = Booking::where('users_id', Auth::id())
            ->where('status', '2')
            ->first();
        if (count($data) > 0){
            return view('guest.pay.index')
                ->with('data', $data);
        }
        return 'anda tidak memiliki data pembayaran';
    }

    public function store(Request $request)
    {
        \DB::transaction(function(){
            $booking = Booking::where('id', $this->request->bookings_id)->first();
            $total_price = $booking->detail_bookings->sum('price');
            $booking->total_price = $total_price;
            $booking->status = '2';
            $booking->name = $this->request->name;
            $booking->phone = $this->request->phone;
            $booking->email = $this->request->email;
            $booking->save();

            if (count($booking->payment) == 0){
                // Save payment ke database
                $payment = Payment::create([
                    'name' => $booking->name,
                    'email' => $booking->email,
                    'phone' => $booking->phone,
                    'bookings_id' => $booking->id,
                    'amount' => floatval($booking->total_price * 1000),
                    'note' => null,
                ]);

                $item_detail = [];
                foreach ($booking->detail_bookings as $detail){
                    $item_detail[] = [
                        'id'       => $detail->id,
                        'price'    => floatval($detail->price * 1000),
                        'quantity' => $detail->night,
                        'name'     => ucwords(str_replace('_', ' ', $detail->type_room->name))
                    ];
                }

                // Buat transaksi ke midtrans kemudian save snap tokennya.
                $payload = [
                    'transaction_details' => [
                        'order_id'      => uniqid(),
                        'gross_amount'  => floatval($booking->total_price * 1000),
                    ],
                    'customer_details' => [
                        'first_name'    => $booking->name,
                        'email'         => $booking->email,
                        'phone'         => $booking->phone,
                        // 'address'       => '',
                    ],
                    'item_details' => $item_detail
                ];
                $snapToken = Veritrans_Snap::getSnapToken($payload);
                $payment->snap_token = $snapToken;
                $payment->save();
            }else{
                $snapToken = $booking->payment->snap_token;
            }
            // Beri response snap token
            $this->response['snap_token'] = $snapToken;
        });

        return response()->json($this->response);
    }

    public function edit(Request $request)
    {

    }

    //notification handler
    public function notificationHandler(Request $request)
    {
        $notif = new Veritrans_Notification();
        \DB::transaction(function() use($notif) {

            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $orderId = $notif->order_id;
            $fraud = $notif->fraud_status;
            $donation = Payment::findOrFail($orderId);

            if ($transaction == 'capture') {

                // For credit card transaction, we need to check whether transaction is challenge by FDS or not
                if ($type == 'credit_card') {

                    if($fraud == 'challenge') {
                        // TODO set payment status in merchant's database to 'Challenge by FDS'
                        // TODO merchant should decide whether this transaction is authorized or not in MAP
                        // $donation->addUpdate("Transaction order_id: " . $orderId ." is challenged by FDS");
                        $donation->setPending();
                    } else {
                        // TODO set payment status in merchant's database to 'Success'
                        // $donation->addUpdate("Transaction order_id: " . $orderId ." successfully captured using " . $type);
                        $donation->setSuccess();
                    }

                }

            } elseif ($transaction == 'settlement') {

                // TODO set payment status in merchant's database to 'Settlement'
                // $donation->addUpdate("Transaction order_id: " . $orderId ." successfully transfered using " . $type);
                $donation->setSuccess();

            } elseif($transaction == 'pending'){

                // TODO set payment status in merchant's database to 'Pending'
                // $donation->addUpdate("Waiting customer to finish transaction order_id: " . $orderId . " using " . $type);
                $donation->setPending();

            } elseif ($transaction == 'deny') {

                // TODO set payment status in merchant's database to 'Failed'
                // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is Failed.");
                $donation->setFailed();

            } elseif ($transaction == 'expire') {

                // TODO set payment status in merchant's database to 'expire'
                // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is expired.");
                $donation->setExpired();

            } elseif ($transaction == 'cancel') {

                // TODO set payment status in merchant's database to 'Failed'
                // $donation->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is canceled.");
                $donation->setFailed();

            }

        });

        return;
    }
}
