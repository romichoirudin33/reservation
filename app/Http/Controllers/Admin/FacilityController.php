<?php

namespace App\Http\Controllers\Admin;

use App\Models\Facility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Toastr;

class FacilityController extends Controller
{

    public function index()
    {
        $data = Facility::all();
        return view('admin.facility.index')->with('data', $data);
    }

    public function create()
    {
        return view('admin.facility.add');
    }

    public function store(Request $request)
    {
        if (Facility::create($request->all())) Toastr::success('Data berhasil di simpan', 'Success');
        return redirect()->route('admin.facility.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('admin.facility.edit')
            ->with('data', Facility::findOrfail($id));
    }

    public function update(Request $request, $id)
    {
        $data = Facility::findOrFail($id);
        if ($data->fill($request->all())->save()) Toastr::success('Data berhasil di simpan', 'Success');
        return redirect()->route('admin.facility.index');
    }

    public function destroy($id)
    {
        Facility::where('id', $id)->delete();
        Toastr::success('Hapus data berhasil', 'Success');
        return redirect()->route('admin.facility.index');
    }
}
