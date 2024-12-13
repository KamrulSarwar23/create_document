<?php

use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserDocumentController;
use App\Models\Documentation;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Home');
})->name('home');


Route::get('public/documents', [UserDocumentController::class, 'PublicDocument'])->name('public.document');
Route::get('public/documents/details/{id}', [UserDocumentController::class, 'PublicDocumentDetail'])->name('public.document.detail');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(['middleware' => ['auth', 'verified', 'role:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/dashboard', [DocumentationController::class, 'dashboard'] )->name('dashboard');

    Route::resource('/documents', DocumentationController::class);
    Route::get('/all/documents', [DocumentationController::class, 'allDocument'])->name('all.document');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');

});


Route::group(['middleware' => ['auth', 'verified', 'role:user'], 'prefix' => 'user', 'as' => 'user.'], function () {

    Route::get('/dashboard', function () {
        return view('user.dashboard.dashboard');
    })->name('dashboard');

    Route::get('/dashboard', [UserDocumentController::class, 'dashboard'] )->name('dashboard');

    Route::resource('/documents', UserDocumentController::class);
    
    Route::get('/all/documents', [UserDocumentController::class, 'allDocument'])->name('all.document');

    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/update/password', [UserProfileController::class, 'updatePassword'])->name('password.update');

});


require __DIR__ . '/auth.php';
