<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\Frontend\LessonDataTable;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Lesson;
use App\Models\Material;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function show(LessonDataTable $dataTable, $materialId)
    {
        $material = Material::findOrFail($materialId);
        return $dataTable->with(['materialId' => $materialId])->render('frontend.material.lesson.show', ['material' => $material]);
    }

    public function rateLesson($lessonId, $materialId)
    {

        $lesson = Lesson::with('comments')->findOrFail($lessonId);
        $rating = Rating::where(['user_id' => Auth::user()->id, 'lesson_id' => $lessonId])->first();
        return view('frontend.rating.index', compact('lesson', 'materialId', 'rating'));
    }

    public function submitRating(Request $request)
    {
        $data = $request->validate([
            'rating' => 'integer|in:1,2,3,4,5',
            'lesson_id' => 'integer|exists:lessons,id',
            'material_id' => 'integer|exists:materials,id'
        ]);

        $data['user_id'] = Auth::user()->id;

        Rating::updateOrCreate(['user_id' => $data['user_id'], 'lesson_id' => $data['lesson_id']], $data);
        return response(['message' => __('Status has been updated')]);
    }
}
