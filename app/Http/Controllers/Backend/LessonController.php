<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ClassesDataTable;
use App\DataTables\LessonDataTable;
use App\DataTables\MaterialDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Lesson;
use App\Models\Material;
use App\Models\User;
use Illuminate\Support\Carbon;

class LessonController extends Controller
{


    public function index(MaterialDataTable $dataTable)
    {
        return $dataTable->render('admin.material.lesson.index');
    }

    public function create(Request $request)
    {
        $materialId = $request->materialId;
        $trackId = $request->trackId;
        $teachers = Material::where('status', 'active')
            ->findOrFail($materialId)->teachers;

        return view('admin.material.lesson.create', compact('teachers', 'materialId', 'trackId'));
    }

    public function store(Request $request)
    {
        $data =  $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'material_id' => ['required', 'exists:materials,id'],
            'teacher_id' => ['sometimes', 'nullable', 'exists:users,id'],
            'track_id' => ['required', 'exists:tracks,id'],
            'date_time' => ['date'],
            'status' => ['in:active,inactive']
        ]);

        Lesson::create($data);

        toastr(__('Created Successfully'));

        return redirect()->route('admin.lesson.index');
    }

    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);

        return view('admin.material.lesson.edit', compact('class'));
    }

    public function show(LessonDataTable $dataTable, $materialId)
    {
        $material = Material::with('track')->findOrFail($materialId);

        return $dataTable->with(['materialId' => $materialId])
            ->render('admin.material.lesson.show', ['material' => $material]);
    }

    public function update(Request $request, string $id)
    {
        $class = classes::findOrFail($id);

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
}
