<?php

use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\ClassesController;
use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Backend\TrackController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ShowDesignController;
use App\Http\Controllers\Backend\EmailInboxController;
use App\Http\Controllers\Backend\HomePageSettingController;
use App\Http\Controllers\Backend\LessonController;
use App\Http\Controllers\Backend\MaterialController;
use App\Http\Controllers\Backend\RatingController;
use App\Http\Controllers\Backend\SocialController;
use App\Http\Controllers\Backend\StudentController;
use App\Http\Controllers\Backend\StudyYearController;
use App\Http\Controllers\Backend\WebsiteColorController;
use App\Http\Controllers\Backend\ClassRoomController;
use App\Http\Controllers\ImportExcelController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'],
    function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        //profile routes
        Route::get('profile', [AdminProfileController::class, 'index'])->name('profile');
        Route::post('profile/update', [AdminProfileController::class, 'profileUpdate'])->name('profile.update');
        Route::post('profile/update/password', [AdminProfileController::class, 'passwordUpdate'])->name('password.update');

        //import
        Route::get('import', [ImportExcelController::class, 'import'])->name('import');

        //settigs
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('logo-setting-update', [SettingController::class, 'logoSettingUpdate'])->name('logo-setting-update.update');
        Route::put('general-settnig-update', [SettingController::class, 'generalSettingUpdate'])->name('general-setting-update.index');

        //student
        Route::get('student-materials/create', [StudentController::class, 'createMaterial'])->name('student.materials.create');
        Route::post('student-materials/store', [StudentController::class, 'storeMaterial'])->name('student.materials.store');
        Route::get('student-materials/{studentId}', [StudentController::class, 'studentMaterials'])->name('student.materials');
        Route::delete('student-materials/', [StudentController::class, 'destroyMaterial'])->name('student.materials.destroy');

        Route::put('student/change-status', [StudentController::class, 'changeStatus'])->name('student.change-status');
        Route::resource('student', StudentController::class);

        //teacher
        Route::get('teacher-materials/create', [TeacherController::class, 'createMaterial'])->name('teacher.materials.create');
        Route::post('teacher-materials/store', [TeacherController::class, 'storeMaterial'])->name('teacher.materials.store');
        Route::delete('teacher-materials/', [TeacherController::class, 'destroyMaterial'])->name('teacher.materials.destroy');
        Route::get('teacher-materials/{teacherId}', [TeacherController::class, 'teacherMaterials'])->name('teacher.materials');

        Route::put('teacher/change-status', [TeacherController::class, 'changeStatus'])->name('teacher.change-status');
        Route::resource('teacher', TeacherController::class);

        //study year
        Route::put('study-year/change-status', [StudyYearController::class, 'changeStatus'])->name('study-year.change-status');
        Route::resource('study-year', StudyYearController::class);

        //class
        Route::put('class/change-status', [ClassesController::class, 'changeStatus'])->name('class.change-status');
        Route::resource('class', ClassesController::class);

        //class rooms
        Route::put('class-room/change-status', [ClassRoomController::class, 'changeStatus'])->name('class-room.change-status');
        Route::resource('class-room', ClassRoomController::class);

        //Materials
        Route::put('material/change-status', [MaterialController::class, 'changeStatus'])->name('material.change-status');
        Route::resource('material', MaterialController::class);

        //lessons
        Route::put('lesson/change-status', [LessonController::class, 'changeStatus'])->name('lesson.change-status');
        Route::resource('lesson', LessonController::class);

        //ratings
        Route::get('rating', [RatingController::class, 'index'])->name('rating.index');

        // update About page
        Route::put('about/update', [AboutController::class, 'update'])->name('about.update');

        // website color
        Route::put('website-color', [WebsiteColorController::class, 'update'])->name('website-color.update');

        // update home page
        Route::put('banner-at-home/change-status', [HomePageSettingController::class, 'changeStatus'])->name('banner-at-home.change-status');
        Route::put('home-page-setting', [HomePageSettingController::class, 'update'])->name('home-page-setting.update');
        Route::put('media-on-home-page', [HomePageSettingController::class, 'mediaOnHomePageUpdate'])->name('media-on-home-page.update');

        //track
        Route::put('track/change-status', [TrackController::class, 'changeStatus'])->name('track.change-status');
        Route::resource('track', TrackController::class);

        //footer social buttons
        Route::put('socials/change-status', [SocialController::class, 'changeStatus'])->name('socials.change-status');
        Route::resource('socials', SocialController::class);
    }
);
