<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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


//Auth
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    //Categoty
    Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
    Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');
    Route::get('/category/edit/{id}', [CategoryController::class, 'EditCategory']);
    Route::post('/category/update/{id}', [CategoryController::class, 'UpdateCategory']);
    Route::delete('softdelete/category/{id}', [CategoryController::class, 'deleteCategory']);
    Route::get('category/restore/{id}', [CategoryController::class, 'RestoreCategory']);
    Route::delete('category/pdelete/{id}', [CategoryController::class, 'PDeleteCategory']);


    //Brand
    Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
    Route::post('/brand/add', [BrandController::class, 'AddBrand'])->name('store.brand');
    Route::get('/brand/edit/{id}', [BrandController::class, 'EditBrand']);
    Route::post('/brand/update/{id}', [BrandController::class, 'UpdateBrand']);
    Route::delete('brand/delete/{id}', [BrandController::class, 'DeleteBrand']);

    //Multi Image
    Route::get('/multi/image', [BrandController::class, 'Multi'])->name('multi');
    Route::post('/multi/add', [BrandController::class, 'AddImage'])->name('add.image');


});



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    //$users = User::all();
    $users = DB::table('users')->get();
    return view('admin.index', compact('users'));

})->name('dashboard');


//Verificar email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

//Resend
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
