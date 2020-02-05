@extends('adminlte::page')

@section('title', 'Type Kamar')

@section('content_header')
    <div style="font-size: 18px;">
        <b>Detail Type Kamar</b>
    </div>
@stop

@section('css')
    <link href="{{ asset('vendor/validetta/validetta.css') }}" rel="stylesheet" type="text/css" media="screen">
@endsection

@section('content')
    <div class="box box-solid flat">
        <div class="box-header">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="pull-left header"><i class="fa fa-th"></i> Detail Type Kamar</li>
                    <li class="dropdown pull-right">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            <span class="fa fa-gears"></span> Setting <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu text-left">
                            <li>
                                <button class="btn btn-default btn-sm btn-flat btn-block"
                                        data-toggle="modal"
                                        data-target="#tambah-gambar">
                                    <span class="fa fa-image"></span> Tambah gambar
                                </button>
                            </li>
                            <li>
                                <button class="btn btn-default btn-sm btn-flat btn-block"
                                        data-toggle="modal"
                                        data-target="#setting-fasilitas">
                                    <span class="fa fa-server"></span> Atur Fasilitas
                                </button>
                            </li>
                            <li>
                                <button class="btn btn-default btn-sm btn-flat btn-block"
                                        data-toggle="modal"
                                        data-target="#tambah-kamar">
                                    <span class="fa fa-plus"></span> Tambah Kamar
                                </button>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-sm-6">
                    <div style="margin-bottom: 10px">
                        @if ($data->room_images->count() > 0)
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @php
                                        $active = true;
                                        $no = 0;
                                    @endphp
                                    @foreach($data->room_images as $room_image)
                                        <li data-target="#carousel-example-generic" data-slide-to="{{ $no }}"
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
                                    @foreach($data->room_images as $room_image)
                                        <div class="item {{ $active ? 'active' : '' }}">
                                            <img src="{{ asset('room_images/'.$room_image->name_file) }}">
                                            <div class="carousel-caption">
                                                <a href="{{ route('admin.delete-image', ['id' => $room_image->id]) }}"
                                                   class="btn btn-danger btn-sm btn-flat">
                                                    <span class="fa fa-trash"></span> Hapus gambar ini
                                                </a>
                                            </div>
                                        </div>
                                        @php
                                            $active = false
                                        @endphp
                                    @endforeach
                                </div>
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                    <span class="fa fa-angle-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                    <span class="fa fa-angle-right"></span>
                                </a>
                            </div>
                        @else
                            <img src="{{ asset('image-not-found.png') }}" alt="" class="img-responsive">
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-xs-8">
                            <h3 class="no-margin">
                                {{ $data->name }}
                            </h3>
                        </div>
                        <div class="col-xs-4">
                            <div class="text-right">
                                <b>(IDR)</b> {{ $data->price }}
                            </div>
                        </div>
                    </div>
                    <div class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        {{ $data->description }}
                    </div>

                    <hr>
                    <div style="margin-bottom: 30px">
                        <h4>Fasilitas</h4>
                        @if(count($data->facilities) > 0)
                            @foreach($data->facilities as $facility)
                                <label class="label label-primary flat">
                                    {{ $facility->name }}
                                </label> &nbsp; <br>
                            @endforeach
                        @else
                            <label class="label label-warning flat">
                                Fasilitas belum di setting !!
                            </label> &nbsp; <br>
                        @endif
                    </div>

                    <div style="margin-bottom: 30px">
                        <h4>Jumlah Kamar {{ $data->name }}</h4>
                        @if(count($data->rooms) > 0)
                            <ul>
                                @foreach($data->rooms as $room)
                                    <li>
                                        {{ $room->name }}
                                        <a href="{{ route('admin.delete-room', ['id' => $room->id]) }}" class="btn btn-danger btn-xs btn-flat">
                                            <span class="fa fa-trash"></span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <label class="label label-warning flat">
                                Jumlah kamar belum di setting !
                            </label> &nbsp; <br>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Setting Fasilitas -->
    <div class="modal fade" id="setting-fasilitas">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Setting Fasilitas</h4>
                </div>
                <form action="{{ route('admin.setting-facility') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="type_rooms_id" value="{{ $data->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>
                                Centang fasilitas
                            </label>
                            @foreach($facilites as $p)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="facilities_id[]"
                                               value="{{ $p->id }}" {{ in_array($p->id, $access) ? "checked" : '' }}> {{ $p->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary btn-flat">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Gambar -->
    <div class="modal fade" id="tambah-gambar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Gambar</h4>
                </div>
                <form action="{{ route('admin.upload-image') }}" method="post"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="type_rooms_id" value="{{ $data->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Foto Kamar</label>
                            <input type="file" name="name_file" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary btn-flat">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Gambar -->
    <div class="modal fade" id="tambah-kamar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Kamar</h4>
                </div>
                <form action="{{ route('admin.add-room') }}" method="post"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="type_rooms_id" value="{{ $data->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Kamar</label>
                            <input type="text" name="name" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary btn-flat">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop