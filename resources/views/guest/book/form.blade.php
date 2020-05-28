@extends('layouts.app-guest')

@section('title', 'Room')

@section('contents')

    @include('guest.slider')

    <div class="p-3">
        <!-- Tambah Book -->
        <div class="row border white-box">
            <div class="col-md-12">
                <h4><b>Room Booking</b></h4>
                <p>Silahkan pilih waktu pemesanan</p>
                <form action="{{ route('guest.store_book') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="type_rooms_id" value="{{ $item->id }}">
                    <input type="hidden" id="price" value="{{ $item->price }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Type Room</label>
                                <input type="text" class="form-control" value="{{ $item->name }}">
                            </div>
                            <div class="col-md-6">
                                <label>No Room</label>
                                <select name="rooms_id" id="rooms_id" class="form-control" required>
                                    <option value="">Pilih No Kamar</option>
                                    @foreach($item->rooms as $room)
                                        <option value="{{ $room->id }}">{{ $room->id }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Check in</label>
                                <input type="date" id="check_in" name="check_in" class="form-control"
                                       value="{{ date('Y-m-d') }}"
                                       required>
                            </div>
                            <div class="col-md-3">
                                <label>Night</label>
                                <input type="number" id="night" name="night" class="form-control" value="1" required>
                            </div>
                            <div class="col-md-3">
                                <label>Check out</label>
                                <input type="date" id="check_out" name="check_out" class="form-control"
                                       value="{{ date('Y-m-d', strtotime('+1 day')) }}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label>Price</label>
                                <input type="text" id="total_price" name="total_price" class="form-control" readonly
                                       value="{{ $item->price }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-outline-primary" type="submit">
                            <span class="fa fa-save"></span> Simpan
                        </button>
                        <a href="{{ route('guest.room') }}" class="btn btn-outline-secondary">
                            <span class="fa fa-arrow-left"></span> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function () {
            $('#night').on('change', function () {
                var night = $('#night').val();
                $('#total_price').val(night * $('#price').val());

                var date = new Date($('#check_in').val());
                date.setDate(date.getDate() + Number(night));
                var str = date.getFullYear()+'-'+('0'+(date.getMonth()+1)).slice(-2)+'-'+('0'+(date.getDate())).slice(-2);
                $('#check_out').val(str);
            });
        });
    </script>
@stop