<?php

namespace App\Http\Controllers;

use App\Imports\StudentsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelController extends Controller
{
    public function import()
    {

        $users =  Excel::import(new StudentsImport(), Storage::disk('local')->path('students.xlsx'));
    }
}
