@extends('layouts.app-guest')

@section('title', 'Home')

@section('slider')
    @include('guest.slider')
@stop

@section('contents')
    <div class="white-box">
        <!-- Deskripsi -->
        <div class="row mb-4">
            <div class="col-md-6">
                <img src="{{ asset('images/welcome-1.jpeg') }}" alt="" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h3><b>Utopic Villa</b></h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium at blanditiis ea eveniet illum
                    inventore magnam porro possimus reiciendis sapiente sequi tempore, veritatis, voluptate. Eveniet
                    itaque modi molestias quasi voluptate.
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium at blanditiis ea eveniet illum
                    inventore magnam porro possimus reiciendis sapiente sequi tempore, veritatis, voluptate. Eveniet
                    itaque modi molestias quasi voluptate.
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium at blanditiis ea eveniet illum
                    inventore magnam porro possimus reiciendis sapiente sequi tempore, veritatis, voluptate. Eveniet
                    itaque modi molestias quasi voluptate.
                </p>
            </div>
        </div>

        <!-- Room -->
        <div class="row">
            <div class="col-md-6">
                <h3>
                    <b>Room</b>
                </h3>
                <div class="border border-danger p-5">
                    Terdiri dari beberapa type kamar serta dengan fasilitas yang memanjakan
                    @php
                        $rooms = \App\Models\TypeRoom::all();
                    @endphp
                    <ul>
                        @foreach($rooms as $room)
                        <li>{{ $room->name }}</li>
                        @endforeach
                    </ul>

                    <a href="{{ route('guest.room') }}" class="btn btn-outline-danger flat">Pesan Sekarang</a>
                </div>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/welcome-2.jpeg') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
@stop