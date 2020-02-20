@extends('layouts.app-guest')

@section('title', 'Room')

@section('contents')

    <div class="card">
        <div class="card-body">
            <h5>
                Kode Booking
                <b>{{ $data->code_booking }}</b>
                <div class="float-right text-muted">
                    <small>
                        <span class="fa fa-clock-o"></span>
                        {{ date('m/d/Y', strtotime($data->updated_at)) }}
                    </small>
                </div>
            </h5>
            <hr>

            <div class="row mb-4">
                <div class="col-8">
                    Invoice <strong>{{ $data->code_booking }}</strong> <br><br>
                    <p>
                        Tgl Dibuat <span class="fa fa-clock-o"></span> {{ date('m/d/Y', strtotime($data->created_at)) }}
                        <br>
                        Tgl Diupdate <span
                                class="fa fa-clock-o"></span> {{ date('m/d/Y', strtotime($data->updated_at)) }}
                    </p>
                </div>
                <div class="col-4">
                    <strong>Data Pemesan</strong> <br><br>
                    <strong>{{ $data->name }}</strong> <br>
                    <p>
                        Phone : {{ $data->phone }} <br>
                        Email : {{ $data->email }}
                    </p>
                </div>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th>Nama Room</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-right">@Harga (IDR)</th>
                    <th class="text-right">@Sub Total (IDR)</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data->detail_bookings as $detail)
                    <tr>
                        <td>{{ $detail->type_room->name }} - {{ $detail->type_room->name }}</td>
                        <td class="text-center">{{ $detail->night }}</td>
                        <td class="text-right">{{ number_format($detail->type_room->price * 1000, 0, ',','.')  }}</td>
                        <td class="text-right">{{ number_format($detail->type_room->price * 1000 * $detail->night, 0, ',','.')  }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="3">Jumlah</th>
                    <th class="text-right">
                        {{ number_format($data->total_price * 1000, 0, ',','.')  }}
                    </th>
                </tr>
                </tfoot>
            </table>

            <row>
                <div class="col-6">
                    <p class="lead">Tersedia Metode Pembayaran:</p>
                    <img src="{{ asset('images/credit/visa.png') }}" alt="Visa">
                    <img src="{{ asset('images/credit/mastercard.png') }}" alt="Mastercard">
                    <img src="{{ asset('images/credit/paypal2.png') }}" alt="Paypal">
                    <p class="text-muted alert alert-secondary" style="margin-top: 10px;">
                        Pastikan jumlah serta detail pemesanan anda sudah benar !
                    </p>
                </div>
                <div class="col-6">

                </div>
            </row>
        </div>
    </div>

@stop