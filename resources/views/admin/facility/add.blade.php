@extends('adminlte::page')

@section('title', 'Fasilitas')

@section('content_header')
    <div style="font-size: 18px;">
        <b>Fasilitas</b>
    </div>
@stop

@section('css')
    <link href="{{ asset('vendor/validetta/validetta.css') }}" rel="stylesheet" type="text/css" media="screen">
@endsection

@section('content')
    <div class="box box-solid flat">
        <div class="box-body">
            <a href="{{ route('admin.facility.index') }}" class="btn btn-xs btn-success flat">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
            <hr>
            <form action="{{ route('admin.facility.store') }}" method="post" id="form"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            Nama Fasilitas
                            <small style="font-size: 8px;vertical-align: 60%">
                                <span class="fa fa-asterisk text-danger"></span>
                            </small>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" name="name" class="form-control" data-validetta="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <button type="submit" class="btn btn-primary btn-flat">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('admin.facility.index') }}" class="btn btn-default flat">
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