@extends('adminlte::page')

@section('title', 'Fasilitas')

@section('content_header')
    <div style="font-size: 18px;">
        <b>Fasilitas</b>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-solid flat">
                <div class="box-body">
                    <a href="{{ route('home') }}" class="btn btn-xs btn-success flat">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('admin.facility.create') }}"
                       class="btn btn-xs btn-primary btn-sm flat pull-right">
                        <i class="fa fa-plus-circle"></i> Tambah
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary flat">
                <div class="box-body">
                    @if(count($data) > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="text-align: center">No</th>
                                <th style="text-align: center">Nama Fasilitas</th>
                                <th style="text-align: center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; ?>
                            @foreach($data as $item)
                                <tr>
                                    <td align="center">{{ $no++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td align="center">
                                        <a href="{{ route('admin.facility.edit', ['id' => $item->id]) }}"
                                           class="btn btn-xs btn-info flat"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>&nbsp;
                                        <button class="btn btn-xs btn-danger flat"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title="Hapus"
                                           onclick="if (confirm('Anda yakin akan menghapus data ini ?')){
                                                   event.preventDefault();
                                                   document.getElementById('delete-{{ $item->id }}').submit();
                                                   };">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <form id="delete-{{ $item->id }}"
                                              action="{{ route('admin.facility.destroy', ['id'=>$item->id]) }}"
                                              method="post">
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="callout callout-info">
                            <h4>Info!</h4>
                            <p>Tidak terdapat data yang di temukan.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $('.table').dataTable({
                "lengthChange": false,
                "ordering": false
            });
        });
    </script>
@endsection