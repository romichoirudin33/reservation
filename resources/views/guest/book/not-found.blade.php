@extends('layouts.app-guest')

@section('title', 'Room')

@section('contents')

    @include('guest.slider')

    <div class="p-3">
        <!-- Data kamar Book -->
        <div class="row border white-box">
            <div class="col-md-12">
                <h4><b>Room Booking</b></h4>
                <div class="alert alert-secondary">
                    <p>
                        Anda tidak memiliki pemesanan ! <br>
                        Silahkan memilih kamar yang akan dipesan ...
                    </p>
                </div>
                <a href="{{ route('guest.room') }}" class="btn btn-outline-primary flat">
                    <span class="fa fa-plus"></span> Mulai pemesanan
                </a>
            </div>
        </div>
    </div>
@stop