<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\MaterialRatingDataTable;
use App\DataTables\MaterialRatingDetailsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Lesson;
use App\Models\Material;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function allMaterialRatings(MaterialRatingDataTable $dataTable)
    {
        return $dataTable->render('admin.rating.index');
    }

    public function materialRatingDetails(MaterialRatingDetailsDataTable $dataTable, $materialId)
    {
        $material = Material::findOrFail($materialId);
        return $dataTable->with(['materialId' => $materialId])->render('admin.rating.material-details', ['material' => $material]);
    }

    public function lessonDetails($lessonId)
    {
        $lesson = Lesson::with(['comments' => function ($query) {
            $query->with('user');
        }])->withCount('ratings')
            ->withCount('comments')
            ->withAvg('ratings', 'rating')
            ->withMin('ratings', 'rating')
            ->withMax('ratings', 'rating')->findOrFail($lessonId);
        return view('admin.rating.lesson-details', compact('lesson'));
    }
}
