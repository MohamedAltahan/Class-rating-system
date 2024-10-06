<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ClassesDataTable;
use App\DataTables\MaterialDataTable;
use App\DataTables\StudentDataTable;
use App\DataTables\StudentMaterialsDataTable;
use App\DataTables\StudentsClassesDataTable;
use App\DataTables\StudentTracksDataTable;
use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\ClassRoom;
use App\Models\Material;
use App\Models\Track;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index(StudentDataTable $dataTable)
    {
        $trackId = request()->trackId;
        $classId = request()->classId;
        $class = Classes::findOrFail($classId);
        return $dataTable->with(['classId' => $classId, 'trackId' => $trackId])
            ->render('admin.student.index', ['class' => $class]);
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
            'phone' => 'required|string|max:50',
            'parent_name' => 'required|string|max:200',
            'studing_status' => 'required|string|in:continuous,pending',
            'birth_place' => 'required|string|max:200',
            'birth_date' => 'required|string',
            'nationality' => 'required|string|max:200',
            'residence_number' => 'sometimes|nullable|string|max:200',
            'residence_date' => 'sometimes|nullable|string',
            'class_id' => 'required|exists:classes,id',
            'class_room_id' => 'required|exists:class_rooms,id',
            'track_id' => 'required|exists:tracks,id',
            'landline_number' => 'sometimes|nullable|string|max:50',
            'status' => 'required|in:active,inactive',
            'password' => 'required|max:30|min:6'
        ]);

        $data['password'] = Hash::make($data['password']);
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
            'phone' => 'required|string|max:50',
            'parent_name' => 'required|string|max:200',
            'studing_status' => 'required|string|in:continuous,pending',
            'birth_place' => 'required|string|max:200',
            'birth_date' => 'required|string',
            'nationality' => 'required|string|max:200',
            'residence_number' => 'sometimes|nullable|string|max:200',
            'residence_date' => 'sometimes|nullable|string',
            'class_id' => 'required|exists:classes,id',
            'class_room_id' => 'required|exists:class_rooms,id',
            'track_id' => 'required|exists:tracks,id',
            'landline_number' => 'sometimes|nullable|string|max:50',
            'status' => 'required|in:active,inactive',
            'password' => 'sometimes|nullable|max:30|min:6'
        ]);

        if (!$data['password']) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

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

    //student materials
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

        $student = User::findOrFail($request->student_id);
        $student->studentMaterials()->syncWithoutDetaching($request->material_id);

        toastr(__('Created Successfully'));

        return redirect()->route('admin.student.materials', $student->id);
    }

    public function destroyMaterial(Request $request)
    {
        $material = Material::findOrFail($request->materialId);
        $student = User::findOrFail($request->studentId);
        $student->studentMaterials()->detach($material->id);

        toastr(__('Deleted Successfully'));
        return response(['status' => 'success', 'message' => __('Deleted Successfully')]);
    }

    public function showStudentsTracks(StudentTracksDataTable $dataTable)
    {
        return $dataTable->render('admin.student.show-students-tracks');
    }

    public function showStudentsClasses(StudentsClassesDataTable $dataTable, $trackId)
    {
        $track = Track::findOrFail($trackId);

        return $dataTable->with(['trackId' => $trackId])
            ->render('admin.student.show-students-classes', ['track' => $track]);
    }
}
