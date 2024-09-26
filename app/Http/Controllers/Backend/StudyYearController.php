<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\studyYearDataTable;
use App\Http\Controllers\Controller;
use App\Models\StudyYear;
use Illuminate\Http\Request;

class StudyYearController extends Controller
{
    public function index(studyYearDataTable $dataTable)
    {
        return $dataTable->render('admin.study-year.index');
    }

    public function create()
    {
        return view('admin.study-year.create');
    }

    public function store(Request $request)
    {
        $data =  $request->validate([
            'name' => ['string', 'max:150'],
            'status' => ['in:active,inactive']
        ]);

        StudyYear::create($data);

        toastr(__('Created Successfully'));

        return redirect()->route('admin.study-year.index');
    }

    public function edit($id)
    {
        $studyYear = StudyYear::findOrFail($id);

        return view('admin.study-year.edit', compact('studyYear'));
    }

    public function update(Request $request, string $id)
    {
        $studyYear = StudyYear::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:100',
            'status' => 'required|in:active,inactive'
        ]);
        $studyYear->update($data);

        toastr(__('Updated Successfully'));

        return redirect()->route('admin.study-year.index');
    }

    public function changeStatus(Request $request)
    {
        $studyYear = StudyYear::findOrFail($request->id);

        $request->status == "true" ? $studyYear->status = 'active' : $studyYear->status = 'inactive';
        $studyYear->save();

        return response(['message' => 'Status has been updated']);
    }
}
