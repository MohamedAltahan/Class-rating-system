<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\MaterialDataTable;
use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Track;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(MaterialDataTable $dataTable)
    {
        return $dataTable->render('admin.material.index');
    }

    public function create()
    {
        $tracks = Track::all();
        return view('admin.material.create', compact('tracks'));
    }

    public function store(Request $request)
    {
        $data =  $request->validate([
            'name' => ['string', 'max:150'],
            'status' => ['in:active,inactive'],
            'track_id' => ['required', 'exists:tracks,id']

        ]);

        Material::create($data);

        toastr(__('Created Successfully'));

        return redirect()->route('admin.material.index');
    }

    public function edit($id)
    {
        $material = Material::findOrFail($id);
        $tracks = Track::all();
        return view('admin.material.edit', compact('material', 'tracks'));
    }

    public function update(Request $request, string $id)
    {
        $material = Material::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'status' => 'required|in:active,inactive',
            'track_id' => ['required', 'exists:tracks,id']

        ]);
        $material->update($data);

        toastr(__('Updated Successfully'));

        return redirect()->route('admin.material.index');
    }

    public function changeStatus(Request $request)
    {
        $material = Material::findOrFail($request->id);

        $request->status == "true" ? $material->status = 'active' : $material->status = 'inactive';
        $material->save();

        return response(['message' => __('Status has been updated')]);
    }
}
