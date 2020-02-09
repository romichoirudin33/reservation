@extends('adminlte::page')

@section('title', 'Pemesanan Baru')

@section('content_header')
    <div style="font-size: 18px;">
        <b>Pemesanan Baru</b>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid flat">
                <div class="box-body">
                    <a href="{{ route('home') }}" class="btn btn-xs btn-success flat">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                    @if($data->count() > 0)
                        <div class="pull-right">
                            <strong>Terdapat : </strong>{{ $data->count() }} Pemesanan Baru
                        </div>
                    @endif
                </div>
            </div>
            <div class="box box-primary flat">
                <div class="box-body">
                    @if(count($data) > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Kode Booking</th>
                                <th>Kamar yg dipesan</th>
                                <th>Detail Pemesan</th>
                                <th>Total Harga (IDR)</th>
                                <th>Tanggal</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.new-booking.show', ['id' =>$item->id]) }}"
                                           class="btn btn-default btn-sm btn-block" data-toggle="tooltip"
                                           data-placement="top"
                                           title="Klik untuk lihat detail pemesanan">
                                            {{ $item->code_booking }} &nbsp;<span class="fa fa-arrow-right"></span>
                                        </a>
                                        <hr>
                                        <button class="btn btn-xs btn-success flat"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Konfirmasi pesanan ini !!"
                                                onclick="if (confirm('Anda yakin mengkonfirmasi pesanan ini bahwa telah melakukan pembayaran ?')){
                                                        event.preventDefault();
                                                        document.getElementById('confirm-{{ $item->id }}').submit();
                                                        };">
                                            <i class="fa fa-check"></i> Konfirmasi Pembayaran
                                        </button>&nbsp;
                                        <button class="btn btn-xs btn-danger flat"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Batalkan pesanan ini !!"
                                                onclick="if (confirm('Anda yakin akan membatalkan pemesanan ini ?')){
                                                        event.preventDefault();
                                                        document.getElementById('delete-{{ $item->id }}').submit();
                                                        };">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <form id="confirm-{{ $item->id }}"
                                              action="{{ route('admin.new-booking.update', ['id'=>$item->id]) }}"
                                              method="post">
                                            <input type="hidden" name="status" value="3">
                                            {{ method_field('PUT') }}
                                            {{ csrf_field() }}
                                        </form>
                                        <form id="delete-{{ $item->id }}"
                                              action="{{ route('admin.new-booking.update', ['id'=>$item->id]) }}"
                                              method="post">
                                            <input type="hidden" name="status" value="0">
                                            {{ method_field('PUT') }}
                                            {{ csrf_field() }}
                                        </form>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach($item->detail_bookings as $detail_booking)
                                                <li>{{ $detail_booking->type_room->name }}
                                                    - {{ $detail_booking->room->name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <span class="fa fa-user"></span> {{ $item->name }} <br>
                                        <span class="fa fa-phone"></span> {{ $item->phone }} <br>
                                        <span class="fa fa-envelope"></span> {{ $item->email }} <br>
                                    </td>
                                    <td>
                                        <h4>{{ $item->total_price }}</h4>
                                    </td>
                                    <td>
                                        Dibuat <br><span
                                                class="fa fa-clock-o"></span> {{ $item->created_at->diffForHumans() }}
                                        <br>
                                        Dibayar <br><span
                                                class="fa fa-money"></span> {{ $item->updated_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="callout callout-info">
                            <h4>Info!</h4>
                            <p>Untuk saat ini belum terdapat pemesanan baru.</p>
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