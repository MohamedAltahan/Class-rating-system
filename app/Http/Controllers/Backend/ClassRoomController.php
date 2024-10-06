<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ClassRoomDataTable;
use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\User;
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
        $classRoom = ClassRoom::findOrFail($id);
        return view('admin.class-room.edit', compact('classRoom'));
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

    public function destroy(string $id)
    {
        $lesson = ClassRoom::findOrFail($id);
        $checkExistance = User::where('class_room_id', $id)->first();
        if ($checkExistance) {
            return response(['status' => 'error', 'message' => __('Can not delete, the item belongs to students.')]);
        }
        $lesson->delete();

        toastr(__('Deleted Successfully'));

        return response(['status' => 'success', 'message' => __('Deleted Successfully')]);
    }
}
