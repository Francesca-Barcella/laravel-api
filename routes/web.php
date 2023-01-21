<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TypeController;

//use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//refactoring delle route, creo una function che gestisce un GRUPPO di route
Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('projects', ProjectController::class)->parameters([
        'projects' => 'project:slug'
    ]);

    Route::resource('types', TypeController::class)->parameters([
        'types' => 'type:slug'
        //excpet serve per escludere le rotte elencate perchè non ci serviranno - check con route:list
    ])->except('show', 'create','edit');
});


require __DIR__ . '/auth.php';
