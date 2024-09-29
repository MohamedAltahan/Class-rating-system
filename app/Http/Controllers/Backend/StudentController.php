<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\StudentDataTable;
use App\DataTables\StudentMaterialsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\ClassRoom;
use App\Models\Material;
use App\Models\Track;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(StudentDataTable $dataTable)
    {
        return $dataTable->render('admin.student.index');
    }

    public function create()
    {
        $classes = Classes::where('status', 'active')->get();
        $tracks = Track::where('status', 'active')->get();
        $rooms = ClassRoom::where('status', 'active')->get();
        return view('admin.student.create', compact('classes', 'tracks', 'rooms'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:200',
            'phone' => 'sometimes|string|max:50',
            'parent_name' => 'required|string|max:200',
            'studing_status' => 'required|string|in:continuous,pending',
            'birth_place' => 'required|string|max:200',
            'birth_date' => 'required|date',
            'nationality' => 'required|string|max:200',
            'residence_number' => 'sometimes|string|max:200',
            'residence_date' => 'sometimes|date',
            'class_id' => 'required|exists:classes,id',
            'class_room_id' => 'required|exists:class_rooms,id',
            'track_id' => 'required|exists:tracks,id',
            'landline_number' => 'sometimes|string|max:50',
            'status' => 'required|in:active,inactive',
            'password' => 'required|max:30|min:6'
        ]);

        User::create($data);

        toastr(__('Crated successfully'));

        return redirect()->route('admin.student.index');
    }

    public function edit(string $id)
    {
        $classes = Classes::where('status', 'active')->get();
        $tracks = Track::where('status', 'active')->get();
        $rooms = ClassRoom::where('status', 'active')->get();
        $student = User::findOrFail($id);
        $operation = 'update';
        return view('admin.student.edit', compact('student', 'operation', 'classes', 'tracks', 'rooms'));
    }

    public function update(Request $request, string $id)
    {
        $student = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:200',
            'phone' => 'sometimes|string|max:50',
            'parent_name' => 'required|string|max:200',
            'studing_status' => 'required|string|in:continuous,pending',
            'birth_place' => 'required|string|max:200',
            'birth_date' => 'required|date',
            'nationality' => 'required|string|max:200',
            'residence_number' => 'sometimes|string|max:200',
            'residence_date' => 'sometimes|date',
            'class_id' => 'required|exists:classes,id',
            'class_room_id' => 'required|exists:class_rooms,id',
            'track_id' => 'required|exists:tracks,id',
            'landline_number' => 'sometimes|string|max:50',
            'status' => 'required|in:active,inactive',
            'password' => 'sometimes|nullable|max:30|min:6'
        ]);

        $student->update($data);

        toastr(__('Updated Successfully'));

        return redirect()->route('admin.student.index');
    }

    public function changeStatus(Request $request)
    {
        $student = User::findOrFail($request->id);

        $request->status == "true" ? $student->status = 'active' : $student->status = 'inactive';
        $student->save();

        return response(['message' => __('Status has been updated')]);
    }

    public function destroy(string $id)
    {
        $student = User::find($id);
        $student->delete();
        toastr(__('Deleted Successfully'));
        return response(['status' => 'success', 'message' => __('Deleted Successfully')]);
    }

    public function studentMaterials(StudentMaterialsDataTable $dataTable, string $studentId)
    {
        $student = User::findOrFail($studentId);

        return $dataTable->with(['studentId' => $student->id])->render('admin.student.materials.index', ['student' => $student]);
    }

    public function createMaterial()
    {
        $studentId = request()->input('studentId');
        $materials = Material::where('status', 'active')->get();
        return view('admin.student.materials.create', compact('studentId', 'materials'));
    }
    public function storeMaterial(Request $request)
    {
        $request->validate([
            'student_id' => ['required', 'exists:users,id'],
            'material_id' => ['required', 'exists:materials,id']
        ]);

        $teacher = User::findOrFail($request->student_id);
        $teacher->materials()->syncWithoutDetaching($request->material_id);

        toastr(__('Created Successfully'));

        return redirect()->route('admin.teacher.materials', $teacher->id);
    }

    public function destroyMaterial(Request $request)
    {
        $material = Material::findOrFail($request->materialId);
        $student = User::findOrFail($request->studentId);
        $student->materials()->detach($material->id);

        toastr(__('Deleted Successfully'));
        return response(['status' => 'success', 'message' => __('Deleted Successfully')]);
    }
}
