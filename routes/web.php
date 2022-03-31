<?php

use Illuminate\Support\Facades\Route;

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

//Area privata
Auth::routes();

Route::middleware('auth')->namespace('Admin')->name('admin.')->prefix('admin')->group(function(){Route::get('/', 'HomeController@index')->name('home');
    Route::resource('/posts', 'PostController');    
});

//Dividiamo le rotte front da quelle back
// Route::get('/', function () {
//     //Rinominiamo per chiarezza la vista 
//     return view('front');
// });

//Area pubblica
//Any è il nome della rotta e lo svincoliamo grazie a quel where() a poter concedere qualsiasi carattere e quel ? a non essere proprio presente
Route::get("{any?}", function(){
    return view("front");
})->where("any", ".*");
