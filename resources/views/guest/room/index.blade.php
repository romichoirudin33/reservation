@extends('layouts.app-guest')

@section('title', 'Room')

@section('contents')

    @include('guest.slider')

    <div class="p-3">
        <!-- Type Room -->
        <div class="row mb-4">
            <div class="col-md-9">
                @foreach($data as $item)
                    <div class="row border mb-2 white-box p-0">
                        <div class="col-sm-4 pl-0">
                            @if ($item->room_images->count() > 0)
                                <img src="{{ asset('room_images/'.$item->room_images->first()->name_file) }}"
                                     class="img-fluid ">
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
                                    <td>
                                        <strong>Start From</strong>
                                    </td>
                                </tr>
                                <tr style="vertical-align: top">
                                    <td>
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
                                    </td>
                                    <td>
                                        <h4 class="text-price">IDR {{ $item->price }}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="100">
                                        <a href="{{ route('guest.room', ['id' => $item->id]) }}"
                                           class="btn btn-outline-primary btn-sm">
                                            Lihat detail kamar
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('guest.book', ['room' => $item->id]) }}"
                                           class="btn btn-primary btn-sm btn-block">
                                            Sewa
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-3">
                <h3><b>Utopic Villa</b></h3>
                <p>
                    Berikut daftar type kamar yang tersedia di Utopic Villa
                </p>
            </div>
        </div>
    </div>
@stop