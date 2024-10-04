<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\MaterialRatingDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index(MaterialRatingDataTable $dataTable)
    {
        return $dataTable->render('admin.rating.index');
    }
}
