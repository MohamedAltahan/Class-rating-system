<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ClassesDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Classes;

class LessonController extends Controller
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

        classes::create($data);

        toastr(__('Created Successfully'));

        return redirect()->route('admin.class.index');
    }

    public function edit($id)
    {
        $class = classes::findOrFail($id);

        return view('admin.class.edit', compact('class'));
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
