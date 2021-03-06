<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Models\Brand;
use App\Models\HomeAbout;
use App\Models\Slider;
use Illuminate\Support\Facades\Route;

use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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
    $brands = Brand::all();
    $sliders = Slider::all();
    $about = HomeAbout::first();
    return view('home', compact('brands', 'sliders', 'about'));
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

    //Admin Slider
    Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');

    Route::get('/add/slider', function () {

        return view('admin.slider.add');

    })->name('add.slider');

    Route::post('/home/slider/add', [HomeController::class, 'StoreSlider'])->name('store.slider');
    Route::get('/home/slider/edit/{id}', [HomeController::class, 'EditSlider'])->name('edit.slider');
    Route::post('/home/slider/update/{id}', [HomeController::class, 'UpdateSlider']);
    Route::delete('/home/slider/delete/{id}', [HomeController::class, 'DeleteSlider']);

    //Admin About
    Route::get('/home/about', function () {

        $about = HomeAbout::first();

        if(!$about){$about = new HomeAbout;}

        return view('admin.about.index', compact('about'));

    })->name('home.about');

    Route::post('/home/about/update/', [HomeController::class, 'UpdateAbout']);

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


Route::get('/user/logout', function () {

    Auth::logout();
    return Redirect()->route('login')->with('success', 'User Logout');

})->name('user.logout');
