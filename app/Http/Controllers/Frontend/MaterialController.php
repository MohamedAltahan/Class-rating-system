<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\Frontend\RatingDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(RatingDataTable $dataTable)
    {
        return $dataTable->render('frontend.material.index');
    }
}
