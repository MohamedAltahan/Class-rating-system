<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ClassesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function index(ClassesDataTable $dataTable)
    {
        return $dataTable->render('admin.class.index');
    }

    public function create()
    {
        return view('admin.class.create');
    }

    public function store(Request $request)
    {
        $data =  $request->validate([
            'name' => ['string', 'max:150'],
            'status' => ['in:active,inactive']
        ]);

        Classes::create($data);

        toastr(__('Created Successfully'));

        return redirect()->route('admin.class.index');
    }

    public function edit($id)
    {
        $class = Classes::findOrFail($id);

        return view('admin.class.edit', compact('class'));
    }

    public function update(Request $request, string $id)
    {
        $class = Classes::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'status' => 'required|in:active,inactive'
        ]);
        $class->update($data);

        toastr(__('Updated Successfully'));

        return redirect()->route('admin.class.index');
    }

    public function changeStatus(Request $request)
    {
        $class = Classes::findOrFail($request->id);

        $request->status == "true" ? $class->status = 'active' : $class->status = 'inactive';
        $class->save();

        return response(['message' => __('Status has been updated')]);
    }

    public function destroy(string $id)
    {
        $class = Classes::findOrFail($id);

        $checkExistance = User::where('class_id', $id)->first();
        if ($checkExistance) {
            return response(['status' => 'error', 'message' => __('Can not delete, the item belongs to students.')]);
        }
        $class->delete();

        toastr(__('Deleted Successfully'));

        return response(['status' => 'success', 'message' => __('Deleted Successfully')]);
    }
}
