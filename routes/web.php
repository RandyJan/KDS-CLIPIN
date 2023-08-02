<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentViewController;
use GuzzleHttp\Middleware;

// // Route::get('sample',[productcontroller::class, 'sample']);
// // Route::get('/dashboard', function () {
// //     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/main',[StudentViewController::class, 'index']);

Route::put('update',[StudentViewController::class, 'update'])->name('up');
Route:: get('/productstatus',[StudentViewController::class,'product']);
Route:: get('/chatime',[StudentViewController::class,'product2']);
Route:: get('/select',[StudentViewController::class,'product3']);
Route:: get('/potatocorner',[StudentViewController::class,'product4']);
Route::post('/confirm', [StudentViewController::class, 'edit']);
Route::post('/notavailable',[StudentViewController::class, 'prodeditn']);
Route::post('/available', [StudentViewController::class, 'prodedita']);
Route::post('/walkinput',[StudentViewController::class, 'walkininput']);
Route::post('/completeinput',[StudentViewController::class, 'completeinput']);
Route::get('/loginsuccessful',[StudentViewController::class, 'logincredentials'])->Middleware('verifyuser');
Route::get('/testlogin',[StudentViewController::class,'userlogin']);
Route::get('/products',[StudentViewController::class,'back']);
Route::post('/completesingle',[StudentViewController::class, 'completesingleinput']);
Route::get('/', function(){
    return view('loginmain');
});

