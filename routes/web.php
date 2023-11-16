<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Postcontroller;
use App\Http\Controllers\Usercontroller;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $posts = Post::all();
    return view('home',['posts' => $posts]);
});

Route::post('/register', [Usercontroller::class, 'register']);
Route::post('/logout',[Usercontroller::class,'logout']);
Route::post('/login',[Usercontroller::class,'login']);

//Blog post related routes
Route::post('create-post', [Postcontroller::class, 'createPost']);
Route::get('/edit-post/{post}', [Postcontroller::class, 'showEditscreen']);
Route::put('/edit-post/{post}', [Postcontroller::class, 'updatedPost']);
Route::delete('/delete-post/{postId}', [Postcontroller::class, 'deletePost'])->name('deletePost');