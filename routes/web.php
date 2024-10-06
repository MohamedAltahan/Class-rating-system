<?php


use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\CommentsController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\DesignDetailsController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LessonController;
use App\Http\Controllers\Frontend\MaterialController;
use App\Http\Controllers\Frontend\StudentController;
use App\Http\Controllers\Frontend\StudentProfileController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Models\Material;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('about', 'about')->name('about');
});

Route::group(
    ['middleware' => ['auth', 'role:student']],
    function () {
        Route::resource('rating', MaterialController::class);

        route::post('lesson/rating/submit', [LessonController::class, 'submitRating'])->name('lesson.submit-rating');
        Route::get('lesson/rate/{lesson_id}/{material_id}', [LessonController::class, 'rateLesson'])->name('lesson.rate-lesson');
        Route::resource('lesson', LessonController::class);

        //comment
        Route::resource('comment', CommentsController::class);

        //profile routes
        Route::get('profile', [StudentProfileController::class, 'index'])->name('profile');
        Route::post('profile/update', [StudentProfileController::class, 'profileUpdate'])->name('profile.update');
        Route::post('profile/update/password', [StudentProfileController::class, 'passwordUpdate'])->name('password.update');
    }
);



require __DIR__ . '/admin.php';
require __DIR__ . '/adminAuth.php';
