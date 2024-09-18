<?php

use App\Enums\UserTypeEnum;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['controller' => EmployeeController::class], function () {
    Route::get('/', 'index')->name('home');
    Route::get('/find', 'find')->name('find');
    Route::get('/job/{job}', 'job')->name('job');
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/register', 'registerForm')->name('register');
        Route::get('/login', 'loginForm')->name('login');
        Route::post('/login', 'doLogin')->name('doLogin');
        Route::post('/register', 'doRegister')->name('doRegister');
    });
    Route::group(['middleware' => 'auth','as:' . UserTypeEnum::Employee->value], function () {
        Route::post('/job/{job}/apply', 'apply')->name('apply');
        Route::patch('/job/{job}/cancel', 'cancel')->name('job.cancel');
        Route::get('/logout', 'logout')->name('logout');
        Route::get('/profile', 'profile')->name('profile');
        Route::put('/profile', 'updateProfile')->name('profile.update');
        Route::get('/applications', 'applications')->name('applications');
    });
});

Route::group(['prefix' => 'employer', 'as' => 'employer.'], function () {
    require __DIR__ . '/auth.php';
    Route::group(['middleware' => ['auth', 'as:' . UserTypeEnum::Employer->value]], function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::group(['middleware' => ['verified'], 'controller' => EmployerController::class], function () {
            Route::get('/dashboard', 'index')->name('dashboard');
            Route::group(['prefix' => 'jobs', 'as' => 'jobs.'], function () {
                Route::get('create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::post('/accept/{application}', 'accept')->name('accept');
                Route::post('/reject/{application}', 'reject')->name('reject');
                Route::get('/{job}/edit', 'edit')->name('edit');
                Route::get('/{job}/applications', 'applications')->name('applications');
                Route::put('/{job}', 'update')->name('update');
                Route::delete('{job}', 'destroy')->name('destroy');
            });
        });
    });
});

