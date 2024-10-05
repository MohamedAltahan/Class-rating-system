<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->validate([
            'comment' => 'required|string|max:1000',
            'lesson_id' => 'required|exists:lessons,id',
        ]);

        $data['user_id'] = Auth()->user()->id;

        Comment::create($data);

        toastr(__('Created Successfully'));

        return redirect()->back();
    }

    public function destroy($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if (Auth::user()->id != $comment->user_id && Auth::user()->role = ! 'admin') {
            abort(403);
        }

        $comment->delete();

        return response(['status' => 'success', 'message' => __('Deleted Successfully')]);
    }
}
