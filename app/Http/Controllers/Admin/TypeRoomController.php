<?php

namespace App\Http\Controllers\Admin;

use App\Models\Facility;
use App\Models\Room;
use App\Models\RoomImage;
use App\Models\TypeRoom;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Toastr;

class TypeRoomController extends Controller
{
    public function index()
    {
        $data = TypeRoom::all();
        return view('admin.type-room.index')->with('data', $data);
    }

    public function create()
    {
        return view('admin.type-room.add');
    }

    public function store(Request $request)
    {
        if ($data = TypeRoom::create($request->all())) Toastr::success('Data berhasil di simpan', 'Success');
        return redirect()->route('admin.type-room.show', ['id' => $data->id]);
    }

    public function show($id)
    {
        $data = TypeRoom::where('id', $id)->first();
        $access = $data->facilities()->pluck('facilities.id')->toArray();
        return view('admin.type-room.show')
            ->with('facilites', Facility::all())
            ->with('access', $access)
            ->with('data', $data);
    }

    public function edit($id)
    {
        return view('admin.type-room.edit')
            ->with('data', TypeRoom::findOrfail($id));
    }

    public function update(Request $request, $id)
    {
        $data = TypeRoom::findOrFail($id);
        if ($data->fill($request->all())->save()) Toastr::success('Data berhasil di simpan', 'Success');
        return redirect()->route('admin.type-room.show', ['id' => $data->id]);
    }

    public function destroy($id)
    {
        TypeRoom::where('id', $id)->delete();
        Toastr::success('Hapus data berhasil', 'Success');
        return redirect()->route('admin.type-room.index');
    }

    public function upload_image(Request $request)
    {
        $id = date('Ymdhi');
        $type_rooms_id = $request->type_rooms_id;
        if ($request->file('name_file')) {
            $name_file = $id . '.' . $request->file('name_file')->extension();

            $request->file('name_file')->move(public_path() . '/room_images', $name_file);
            RoomImage::create(['name_file' => $name_file, 'type_rooms_id' => $type_rooms_id]);
        }
        Toastr::success('Data berhasil di simpan', 'Success');
        return redirect()->route('admin.type-room.show', ['id' => $type_rooms_id]);
    }

    public function delete_image($id)
    {
        $data = RoomImage::findOrfail($id);
        $type_rooms_id = $data->type_rooms_id;
        $data->delete();

        Toastr::success('Data berhasil di hapus', 'Success');
        return redirect()->route('admin.type-room.show', ['id' => $type_rooms_id]);
    }

    public function setting_facility(Request $request)
    {
        $id = $request->type_rooms_id;
        $data = TypeRoom::where('id', $id)->first();
        $data->facilities()->sync($request->facilities_id);

        if ($data->save()) Toastr::success('Simpan data berhasil', 'Success');

        return redirect()->route('admin.type-room.show', ['id' => $data->id]);
    }

    public function add_room(Request $request)
    {
        if ($data = Room::create($request->all())) Toastr::success('Data berhasil di simpan', 'Success');
        return redirect()->route('admin.type-room.show', ['id' => $data->type_rooms_id]);
    }

    public function delete_room($id)
    {
        $data = Room::findOrfail($id);
        $type_rooms_id = $data->type_rooms_id;
        $data->delete();

        Toastr::success('Data berhasil di hapus', 'Success');
        return redirect()->route('admin.type-room.show', ['id' => $type_rooms_id]);
    }
}
