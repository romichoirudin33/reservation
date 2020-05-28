@extends('layouts.app-guest')

@section('title', 'Room')

@section('contents')

    {{--    @include('guest.slider')--}}

    <div class="p-3">
        <!-- Data kamar Book -->
        <div class="row border white-box">
            <div class="col-md-12">
                <h4><b>Room Booking</b></h4>
                <small>Silahkan di cek kembali pesanan kamar anda</small>
                @if($data->detail_bookings->count() > 0)
                    @foreach($data->detail_bookings as $detail)
                        <div class="row border p-2 mt-2 mb-2">
                            <div class="col-md-6">
                                <h5 class="mb-3">{{ $detail->type_room->name }} - {{ $detail->room->name }}</h5>

                                <table style="width: 80%">
                                    <tr>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                        <th>Night</th>
                                    </tr>
                                    <tr>
                                        <td>{{ date('m/d/Y', strtotime($detail->check_in))  }}</td>
                                        <td>{{ date('m/d/Y', strtotime($detail->check_out))  }}</td>
                                        <td>{{ $detail->night }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <div class="float-right">
                                    <a href="{{ route('guest.book.edit', ['id' => $detail->id]) }}"
                                       class="btn btn-outline-primary btn-sm flat">
                                        <span class="fa fa-edit"></span> Edit
                                    </a>
                                    <button class="btn btn-outline-danger btn-sm flat"
                                            onclick="if (confirm('Anda yakin akan menghapus data ini ?')){
                                                    event.preventDefault();
                                                    document.getElementById('delete-{{ $detail->id }}').submit();
                                                    };">
                                        <span class="fa fa-trash"></span> Hapus
                                    </button>
                                    <form id="delete-{{ $detail->id }}"
                                          action="{{ route('guest.book.destroy', ['id'=>$detail->id]) }}"
                                          method="post">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-secondary">
                        <p>
                            Anda tidak memiliki pemesanan !
                        </p>
                    </div>
                @endif
                <a href="{{ route('guest.room') }}" class="btn btn-outline-primary flat">
                    <span class="fa fa-plus"></span> Tambah pesanan lainnya
                </a>
            </div>
        </div>

        <!-- Data pemesan -->
        <div class="row mt-5">
            <div class="col-md-8">
                <h4>Informasi Pemesan</h4>
                <small>Mohon di isi data pemesan berikut ini</small>

                <div class="mt-4">
                    {{ csrf_field() }}
                    <input type="hidden" name="bookings_id" id="bookings_id" value="{{ $data->id }}">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" id="name" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label>Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" id="email" class="form-control" autocomplete="off"
                                   required>
                        </div>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('welcome') }}" class="btn btn-secondary">
                            Batalkan <span class="fa fa-times"></span>
                        </a>
                        <button class="btn btn-primary float-right" onclick="return submitForm();">
                            Lanjutkan ke pembayaran <span class="fa fa-arrow-right"></span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h4>Total Pesanan</h4>
                <small>Detail yang harus di bayar</small>
                <div class="card mt-4">
                    <div class="card-body">
                        @php
                            $sub_total = 0;
                        @endphp
                        @foreach($data->detail_bookings as $detail)
                            @php
                                $sub_total += ($detail->price * 1000)
                            @endphp
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="font-weight-bold">{{ $detail->type_room->name }} -
                                        {{ $detail->room->name }}</div>
                                    <p class="text-muted">
                                        {{ $detail->night }} x
                                        @IDR {{ number_format($detail->type_room->price * 1000, 0, ',','.')  }}
                                    </p>
                                </div>
                                <div class="col-md-4 text-right">
                                    <strong>IDR</strong>
                                    <div class="font-weight-bold">
                                        {{ number_format($detail->price * 1000, 0, ',','.')  }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-header">
                        <table style="width: 100%">
                            <tr>
                                <td>
                                    <h6 class="font-weight-bold text-muted">
                                        Sub Total
                                    </h6>
                                </td>
                                <td>
                                    <h6 class="font-weight-bold text-right text-muted">
                                        (IDR) {{ number_format($sub_total, 0, ',','.')  }}
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5 class="font-weight-bold">
                                        Total Dibayar
                                    </h5>
                                </td>
                                <td>
                                    <h5 class="font-weight-bold text-right">
                                        (IDR) {{ number_format($sub_total, 0, ',','.')  }}
                                    </h5>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
    <script src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}"
            data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script>
        const socket = io('http://localhost:3000');

        function submitForm() {
            var konfirm = confirm("Anda yakin akan melanjutkan ke pembayaran");
            if (konfirm) {
                var string = 'Terjadi pemesanan baru dengan kode booking {{ $data->code_booking }}';
                socket.emit('booking', {data: string});
                // Kirim request ajax
                $.post("{{ route('guest.pay.store') }}",
                    {
                        _method: 'POST',
                        _token: '{{ csrf_token() }}',
                        bookings_id: $('input#bookings_id').val(),
                        name: $('input#name').val(),
                        email: $('input#email').val(),
                        phone: $('input#phone').val()
                    },
                    function (data, status) {
                        snap.pay(data.snap_token, {
                            // Optional
                            onSuccess: function (result) {
                                location.reload();
                            },
                            // Optional
                            onPending: function (result) {
                                location.reload();
                            },
                            // Optional
                            onError: function (result) {
                                location.reload();
                            }
                        });
                    });
            }
            return false;
        }
    </script>
@stop