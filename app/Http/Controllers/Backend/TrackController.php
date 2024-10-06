<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\TrackDataTable;
use App\Http\Controllers\Controller;
use App\Models\Track;
use App\Models\User;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    use fileUploadTrait;

    public function index(TrackDataTable $dataTable)
    {
        return $dataTable->render('admin.track.index');
    }

    public function create()
    {
        return view('admin.track.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:200'],
            'status' => ['required'],
        ]);

        toastr(__('Saved successfully'));

        Track::create($request->all());

        return  redirect()->route('admin.track.index');
    }


    public function edit(string $id)
    {
        $track = Track::findOrFail($id);

        return view('admin.track.edit', compact('track'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:200'],
            'status' => ['required'],
        ]);

        $track = Track::findOrFail($id);

        $track->update($request->all());
        toastr('updated successfully');
        return redirect()->route('admin.track.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $track = Track::findOrFail($id);

        $trackCheck = User::where('track_id', $track->id)->first();

        if (isset($trackCheck)) {
            return response(['status' => 'error', 'message' => __('Can not delete this track, it contains students.')]);
        }

        $track->delete();

        return response(['status' => 'success', 'message' => __('Deleted Successfully')]);
    }

    //change status using ajax request _________________________________________________________
    public function changeStatus(Request $request)
    {
        $track = track::findOrFail($request->id);

        $request->status == "true" ? $track->status = 'active' : $track->status = 'inactive';
        $track->save();

        return response(['message' => __('Status has been updated')]);
    }
}
