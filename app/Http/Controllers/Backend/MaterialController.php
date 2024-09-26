<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\MaterialDataTable;
use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(MaterialDataTable $dataTable)
    {
        return $dataTable->render('admin.material.index');
    }

    public function create()
    {
        return view('admin.material.create');
    }

    public function store(Request $request)
    {
        $data =  $request->validate([
            'name' => ['string', 'max:150'],
            'status' => ['in:active,inactive']
        ]);

        Material::create($data);

        toastr(__('Created Successfully'));

        return redirect()->route('admin.material.index');
    }

    public function edit($id)
    {
        $material = Material::findOrFail($id);

        return view('admin.material.edit', compact('material'));
    }

    public function update(Request $request, string $id)
    {
        $material = Material::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'status' => 'required|in:active,inactive'
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
    }  //
}
