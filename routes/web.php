<?php

use App\Models\Post;
use App\Models\Friend;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FriendController;

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
    $post = Post::all();
    if(Auth::id())
    {
        $role=Auth()->user()->role;
        if($role == 'admin')
        {
            return view('adminhome');
        }
    }
    return view('home',['posts'=> $post]);
});

Route::get('/friend', function () {
    $user = Friend::all();
    return view('home',['users'=> $user]);
});

Route::post('/register',[UserController::class,'register']);
Route::post('/logout',[UserController::class,'logout']);
Route::post('/login',[UserController::class,'login']);

//Blog post related routes
Route::post('/create-post',[PostController::class,'createPost']);
Route::get('/edit-post/{post}',[PostController::class,'showEditscreen']);
Route::put('/edit-post/{post}',[PostController::class,'updatedPost']);
Route::delete('/delete-post/{post}',[PostController::class,'deletePost']);

//Add friend related routes
Route::get('/friend',[FriendController::class,'friendscreen']);
Route::get('/friend', [FriendController::class, 'index'])->name('home');
Route::post('/user/{id}/add-friend', [UserController::class, 'addFriend'])->name('add.friend');


