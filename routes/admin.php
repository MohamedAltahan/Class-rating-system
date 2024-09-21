<?php

use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Backend\TrackController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ShowDesignController;
use App\Http\Controllers\Backend\EmailInboxController;
use App\Http\Controllers\Backend\HomePageSettingController;
use App\Http\Controllers\Backend\SocialController;
use App\Http\Controllers\Backend\WebsiteColorController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'],
    function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        //profile routes _________________________________________________________________________________________
        Route::get('profile', [AdminProfileController::class, 'index'])->name('profile');
        Route::post('profile/update', [AdminProfileController::class, 'profileUpdate'])->name('profile.update');
        Route::post('profile/update/password', [AdminProfileController::class, 'passwordUpdate'])->name('password.update');

        //settigs _________________________________________________________________________________________
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('logo-setting-update', [SettingController::class, 'logoSettingUpdate'])->name('logo-setting-update.update');
        Route::put('general-settnig-update', [SettingController::class, 'generalSettingUpdate'])->name('general-setting-update.index');

        //teacher routes__________________________________________________________________________________________
        Route::put('teacher/change-status', [TeacherController::class, 'changeStatus'])->name('teacher.change-status');
        Route::resource('teacher', TeacherController::class);

        //sub category routes_______________________________________________________________________________________
        Route::put('sub-category/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
        Route::resource('sub-category', SubCategoryController::class);

        // update About page______________________________________________________________________________
        Route::put('about/update', [AboutController::class, 'update'])->name('about.update');

        // website color______________________________________________________________________________
        Route::put('website-color', [WebsiteColorController::class, 'update'])->name('website-color.update');

        // update home page______________________________________________________________________________
        Route::put('banner-at-home/change-status', [HomePageSettingController::class, 'changeStatus'])->name('banner-at-home.change-status');
        Route::put('home-page-setting', [HomePageSettingController::class, 'update'])->name('home-page-setting.update');
        Route::put('media-on-home-page', [HomePageSettingController::class, 'mediaOnHomePageUpdate'])->name('media-on-home-page.update');

        //desgin _____________________________________________________________________________
        Route::put('track/change-status', [TrackController::class, 'changeStatus'])->name('track.change-status');
        Route::resource('track', TrackController::class);

        //show desgins page____________________________________________________________________________________
        Route::get('show-designs', [ShowDesignController::class, 'index'])->name('show-designs.index');

        //sub category routes _____________________________________________________________________________________
        Route::get('get-sub-categories', [SubCategoryController::class, 'getSubCategories'])->name('get-sub-categories');

        //email inbox_____________________________________________________________________________________________
        Route::get('email-inbox', [EmailInboxController::class, 'index'])->name('get-emails.index');
        Route::get('email-inbox/show/{id}', [EmailInboxController::class, 'show'])->name('get-emails.show');

        //footer social buttons---------------------------
        Route::put('socials/change-status', [SocialController::class, 'changeStatus'])->name('socials.change-status');
        Route::resource('socials', SocialController::class);
    }
);
