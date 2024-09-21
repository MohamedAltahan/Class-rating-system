<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\TeacherDataTable;
use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\User;
use App\Models\Design;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TeacherDataTable $dataTable, Request $request)
    {
        return $dataTable->render('admin.teacher.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'max:200'],
            'description' => ['sometimes', 'string', 'max:2000'],
            'status' => ['required'],
            'phone' => ['sometimes', 'string', 'max:20'],
        ]);

        $slug = Str::slug($request->name);

        $request->merge(['username' => $slug]);

        $request->merge(['role' => 'teacher']);

        User::create($request->all());

        toastr('Created Successfully');

        return redirect()->route('admin.teacher.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = User::findOrFail($id);
        return view('admin.teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => ['required', 'max:200'],
            'description' => ['sometimes', 'string', 'max:2000'],
            'status' => ['required', 'in:active,inactive'],
            'phone' => ['sometimes', 'string', 'max:20'],
        ]);

        $teacher = User::findOrFail($id);

        $teacher['username'] = Str::slug($request->name);

        $teacher->update($request->all());

        toastr(__('updated Successfully'));

        return redirect()->route('admin.teacher.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = User::find($id);
        if (!isset($teacher)) {
            return response(['status' => 'error', 'message' => __('Can not delete, the item not found.')]);
        }

        $design = Classes::where('teacher_id', $id)->first();

        if (isset($design)) {
            return response(['status' => 'error', 'message' => __('Can not delete this teacher, he has classes.')]);
        }

        $teacher->delete();
        toastr(__('Deleted Successfully'));
        return response(['status' => 'success', 'message' => __('Deleted Successfully')]);
    }

    //change status using ajax request--------------------------------------------------
    public function changeStatus(Request $request)
    {
        $teacher = User::findOrFail($request->id);

        $request->status == "true" ? $teacher->status = 'active' : $teacher->status = 'inactive';
        $teacher->save();

        return response(['message' => __('Status has been updated')]);
    }
}
