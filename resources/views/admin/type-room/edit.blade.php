@extends('adminlte::page')

@section('title', 'Type Kamar')

@section('content_header')
    <div style="font-size: 18px;">
        <b>Type Kamar</b>
    </div>
@stop

@section('css')
    <link href="{{ asset('vendor/validetta/validetta.css') }}" rel="stylesheet" type="text/css" media="screen">
@endsection

@section('content')
    <div class="box box-solid flat">
        <div class="box-body">
            <a href="{{ route('admin.type-room.index') }}" class="btn btn-xs btn-success flat">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
            <hr>
            <form action="{{ route('admin.type-room.update', ['id' => $data->id]) }}" method="post" id="form"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            Nama Type Kamar
                            <small style="font-size: 8px;vertical-align: 60%">
                                <span class="fa fa-asterisk text-danger"></span>
                            </small>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" name="name" class="form-control" data-validetta="required" autocomplete="off" value="{{ $data->name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            Deskripsi
                            <small style="font-size: 8px;vertical-align: 60%">
                                <span class="fa fa-asterisk text-danger"></span>
                            </small>
                        </label>
                        <div class="col-sm-6">
                            <textarea name="description" class="form-control" rows="10" data-validetta="required" autocomplete="off">{{ $data->description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            Harga (IDR)
                            <small style="font-size: 8px;vertical-align: 60%">
                                <span class="fa fa-asterisk text-danger"></span>
                            </small>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" name="price" class="form-control" data-validetta="required,number" autocomplete="off" value="{{ $data->price }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <button type="submit" class="btn btn-primary btn-flat">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('admin.type-room.index') }}" class="btn btn-default flat">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </form>
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