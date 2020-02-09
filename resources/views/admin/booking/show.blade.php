@extends('adminlte::page')

@section('title', 'Detail Pemesanan')

@section('content_header')
    <div style="font-size: 18px;">
        <b>Detail Pemesanan</b>
    </div>
@stop

@section('css')
    <link href="{{ asset('vendor/validetta/validetta.css') }}" rel="stylesheet" type="text/css" media="screen">
    <style>
        .table > tbody > tr > td {
            padding-top: 2px;
            padding-bottom: 2px;
        }
    </style>
@endsection

@section('content')
    <div class="box box-solid flat">
        <div class="box-body">
            <a href="{{ route('admin.booking.index') }}" class="btn btn-xs btn-success flat">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            Keterangan Pemesan <br><br>
                            <address>
                                <strong>{{ $data->name }}</strong><br>
                                Phone: {{ $data->phone }}<br>
                                Email: {{ $data->email }}
                            </address>
                            <br>
                            @if($data->status == 2)
                                <strong>
                                    Status (TELAH DI BAYAR)
                                </strong>
                            @endif
                        </div><!-- /.col -->
                        <div class="col-sm-6 invoice-col">
                            <b>Code Booking #{{ $data->code_booking }}</b><br>
                            <br>
                            <b>Dibuat:</b> {{ $data->created_at->format('d-m-Y h:i:s') }}<br>
                            <b>Dikonfirmasi:</b> {{ $data->updated_at->format('d-m-Y h:i:s') }}<br>
                            <br>
                            <b>Total Harga (IDR) {{ $data->total_price }}</b><br>
                            <br>
                        </div><!-- /.col -->
                    </div>
                    <div class="well well-sm" style="margin-top: 5px">
                        <strong>Info</strong>
                        <p>
                            Pemesanan telah dikonfirmasi.<br>
                            Pemesanan yang sudah di konfirmasi tidak dapat di batalkan.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <label>Kamar</label>
                    @foreach($data->detail_bookings as $detail_booking)
                        <div class="well well-sm no-shadow">
                            <table class="table table-bordered" style="padding: 0">
                                <tr>
                                    <td colspan="4">
                                        <h4>{{ $detail_booking->type_room->name }}
                                            - {{ $detail_booking->room->name }}</h4>
                                    </td>
                                    <td>
                                        <strong>{{ $detail_booking->price }} (IDR)</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Check In</td>
                                    <td>Check Out</td>
                                    <td>Sewa</td>
                                    <td colspan="2"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>{{ $detail_booking->check_in }}</strong>
                                    </td>
                                    <td><strong>{{ $detail_booking->check_out }}</strong></td>
                                    <td><strong>{{ $detail_booking->night }} Malam</strong></td>
                                    <td colspan="2"></td>
                                </tr>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('vendor/validetta/validetta.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/validetta/lang/validettaLang-ID.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#form").validetta({
                realTime: true,
                display: 'inline',
                errorTemplateClass: 'validetta-inline'
            });
            $(".select2").select2();
        });
    </script>
@endsection