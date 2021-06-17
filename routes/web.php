<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
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

/*Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return 'Hola Mundo';
});

Route::get('foo', function () {
    return 'Hello World ';
});

Route::redirect('/foo2', '/foo');*/
Route::get('/exit',[SiteController::class, 'exitApp'])->name('exit');

Route::redirect('/', '/home');
Route::get('/home', [SiteController::class, 'home'])->name('home'); //arreglo Controlador, accion
Route::get('/services', [SiteController::class, 'services'])->name('services');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
//Route::get('/blog', [SiteController::class, 'blog'])->name('blog');

Route::get('/json',[ App\Http\Controllers\BlogController::class, 'json']) ->name('json');

Route::resource('blog', \App\Http\Controllers\BlogController::class)->middleware('auth'); //Genera las rutas del controlador

Route::resource('comment', \App\Http\Controllers\CommentController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/datatable',[ App\Http\Controllers\BlogController::class, 'datatable']) ->name('datatable');
Route::get('/datatable_data',[ App\Http\Controllers\BlogController::class, 'datatable_data']) ->name('datatable_data');
Route::get('/datatable_comments/{id}',[ App\Http\Controllers\BlogController::class, 'datatable_comments']) ->name('datatable_comments');

