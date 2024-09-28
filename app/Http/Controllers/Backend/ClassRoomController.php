<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ClassRoomDataTable;
use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    public function index(ClassRoomDataTable $dataTable)
    {
        return $dataTable->render('admin.class-room.index');
    }

    public function create()
    {
        return view('admin.class-room.create');
    }

    public function store(Request $request)
    {
        $data =  $request->validate([
            'name' => ['string', 'max:150'],
            'status' => ['in:active,inactive']
        ]);

        ClassRoom::create($data);

        toastr(__('Created Successfully'));

        return redirect()->route('admin.class-room.index');
    }

    public function edit($id)
    {
        $class = ClassRoom::findOrFail($id);
        return view('admin.class-room.edit', compact('class'));
    }

    public function update(Request $request, string $id)
    {
        $class = ClassRoom::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'status' => 'required|in:active,inactive'
        ]);
        $class->update($data);

        toastr(__('Updated Successfully'));

        return redirect()->route('admin.class-room.index');
    }

    public function changeStatus(Request $request)
    {
        $class = ClassRoom::findOrFail($request->id);

        $request->status == "true" ? $class->status = 'active' : $class->status = 'inactive';
        $class->save();

        return response(['message' => __('Status has been updated')]);
    }
}
