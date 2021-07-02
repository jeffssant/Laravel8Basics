<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

use App\Models\User;
use Illuminate\Support\Facades\DB;

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

Route::get('/about', function () {
    return view('about');
})->middleware('check');


//Route::get('/contact', 'ContactController@index'); Laravel 7 <


Route::get('/contsdfsdfasact', [ContactController::class, 'index'])->name('con');

//Category Controller
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    //$users = User::all();
    $users = DB::table('users')->get();
    return view('dashboard', compact('users'));

})->name('dashboard');
