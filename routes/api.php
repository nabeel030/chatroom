<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/chatrooms/create', [ChatroomController::class, 'create']);
    Route::post('/chatrooms', [ChatroomController::class, 'index']);
    Route::post('/chatrooms/{id}/enter', [ChatroomController::class, 'enter']);
    
    Route::middleware('check.user.in.chatroom')->group(function () {
        Route::post('/chatrooms/{id}/leave', [ChatroomController::class, 'leave']);
        Route::post('/chatrooms/{id}/message/send', [MessageController::class, 'send']);
        Route::post('/chatrooms/{id}/messages', [MessageController::class, 'list']);
    });
});
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::post('/chatrooms/create', [ChatroomController::class, 'create']);
// Route::post('/chatrooms', [ChatroomController::class, 'index']);
// Route::post('/chatrooms/{id}/enter', [ChatroomController::class, 'enter']);

// Route::middleware('check.user.in.chatroom')->group(function () {
//     Route::post('/chatrooms/{id}/leave', [ChatroomController::class, 'leave']);
//     Route::post('/chatrooms/{id}/message/send', [MessageController::class, 'send']);
//     Route::post('/chatrooms/{id}/messages', [MessageController::class, 'list']);
// });

// Route::post('/chatrooms/{id}/leave', [ChatroomController::class, 'leave']);
// Route::post('/chatrooms/{id}/message/send', [MessageController::class, 'send']);
// Route::post('/chatrooms/{id}/messages', [MessageController::class, 'list'])
//         ->middleware('check.user.in.chatroom');

// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('/chatrooms', 'ChatroomController@create');
//     Route::get('/chatrooms', 'ChatroomController@index');
//     Route::post('/chatrooms/{id}/enter', 'ChatroomController@enter');
//     Route::post('/chatrooms/{id}/leave', 'ChatroomController@leave');
//     Route::post('/chatrooms/{id}/messages', 'MessageController@send');
//     Route::get('/chatrooms/{id}/messages', 'MessageController@list');
// });