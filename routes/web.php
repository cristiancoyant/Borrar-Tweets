<?php
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\TwitterController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\TweetController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;  
use Inertia\Inertia;
 

//Rutas tipo GET
Route::get('/tweets', [MediaController::class ,'TweetsIndex'])->name('home.tweets');
Route::get('/FL', [TweetController::class ,'regreso'])->name('regreso');
Route::get('/', HomeController::class)->name('home.index');
Route::get('/auth/twitter/redirect', [MediaController::class, 'connect_twitter'])->name('login.twitter');
Route::get('/auth/twitter/callback', [MediaController::class, 'Twitter_cbk'])->name('Formulario');
Route::get('/Logout', [MediaController::class , 'Logout'])->name('Logout');
//Rutas tipo POST
Route::post('/Postear', [MediaController::class , 'Postear'])->name('Posteo');
Route::post('/Delete',[TweetController::class , 'DestroyTweets'])->name('Destroy');
