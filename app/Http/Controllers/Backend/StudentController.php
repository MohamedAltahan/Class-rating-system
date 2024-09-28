<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\ClassRoom;
use App\Models\Track;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() {}

    public function create()
    {
        $classes = Classes::where('status', 'active')->get();
        $tracks = Track::where('status', 'active')->get();
        $rooms = ClassRoom::where('status', 'active')->get();
        return view('admin.student.create', compact('classes', 'tracks', 'rooms'));
    }
}
