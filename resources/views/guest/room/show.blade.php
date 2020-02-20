@extends('layouts.app-guest')

@section('title', 'Room')

@section('contents')

    @include('guest.slider')

    <div class="p-3">
        <!-- Type Room -->
        <div class="row border mb-2 white-box p-0">
            <div class="col-sm-4 pl-0">
                @if ($item->room_images->count() > 0)
                    <div id="carouselShow" class="carousel slide" data-ride="carousel">

                        <ol class="carousel-indicators">
                            @php
                                $active = true;
                                $no = 0;
                            @endphp
                            @foreach($item->room_images as $room_image)
                                <li data-target="#carouselShow" data-slide-to="{{ $no }}"
                                    class="{{ $active ? 'active' : '' }}"></li>
                                @php
                                    $active = false;
                                    $no++;
                                @endphp
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @php
                                $active = true
                            @endphp
                            @foreach($item->room_images as $room_image)
                                <div class="carousel-item {{ $active ? 'active' : '' }}">
                                    <img src="{{ asset('room_images/'.$room_image->name_file) }}" class="d-block w-100"
                                         alt="...">
                                </div>
                                @php
                                    $active = false
                                @endphp
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselShow" role="button"
                           data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselShow" role="button"
                           data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                @else
                    <img src="{{ asset('image-not-found.png') }}" alt="" class="img-fluid">
                @endif
            </div>
            <div class="col-sm-8 pt-2">
                <table width="100%">
                    <tr>
                        <td width="80%">
                            <h4><b>{{ $item->name }}</b></h4>
                        </td>
                        <td>ad
                            <strong>Mulai dari</strong>
                        </td>
                    </tr>
                    <tr style="vertical-align: top">
                        <td>
                            {{ $item->description }} <br><br>
                            <div class="text-muted">
                                @if(count($item->facilities) > 0)
                                    <ul>
                                        @foreach($item->facilities as $facility)
                                            <li>{{ $facility->name }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    Tidak ditemukan fasilitas
                                @endif
                            </div>
                            <br>
                        </td>
                        <td>
                            <h4 class="text-price">IDR {{ $item->price }}</h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Jumlah Kamar</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            @if(count($item->rooms) > 0)
                                <ul>
                                    @foreach($item->rooms as $room)
                                        <li>{{ $room->name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td height="100">
                            <a href="{{ route('guest.room') }}"
                               class="btn btn-outline-primary btn-sm">
                                Kembali
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('guest.book', ['room' => $item->id]) }}" class="btn btn-primary btn-sm btn-block">
                                Sewa
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@stop