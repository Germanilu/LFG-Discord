<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\ChannelUserController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function(){
    return 'Welcome to my API';
});



Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);



//Aqui creo un grupo con el middleware que controla el token 
Route::group(
    ['middleware' => 'jwt.auth'],
    function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::get('/logout', [AuthController::class, 'logout']);
    }
);


//Provide SuperAdmin Powers
Route::group(
    ['middleware' => ['jwt.auth','is.super.admin']],
    function(){
        Route::post('/addRoleSuperAdmin/{id}', [UserController::class, 'addRoleSuperAdminToId']);
        Route::delete('/deleteRoleSuperAdmin/{id}',[UserController::class, 'deleteRoleSuperAdminToId']);
    }
);


Route::group(
    ['middleware' => ['jwt.auth']],
    function(){
        Route::post('/addChannel/{id}', [ChannelController::class, 'createNewChannel']);
        Route::get('/channel', [ChannelController::class, 'getAllChannels']);
        Route::get('/channel/{id}', [ChannelController::class, 'getChannelById']);

        Route::put('/channel/{id}', [ChannelController::class, 'modifyChannelById']);
        Route::delete('/deleteChannel/{id}',[ChannelController::class, 'deleteChannelById']);
    }
);

//Control Entrance Channel-User
Route::group(
    ['middleware' => ['jwt.auth']],
    function(){
        Route::post('/addUserToChannel/{id}', [ChannelUserController::class, 'addUserToChannel']);
        Route::delete('/deleteUserFromChannel/{id}',[ChannelUserController::class, 'deleteUserFromChannel']);
    }
);