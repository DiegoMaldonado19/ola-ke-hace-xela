<?php

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Api\v1\UserController as UserV1;
use  App\Http\Controllers\Api\v1\PostController as PostV1;
use  App\Http\Controllers\Api\v1\UserRoleController as UserRoleV1;
use  App\Http\Controllers\Api\v1\ReportController as ReportV1;
use  App\Http\Controllers\Api\v1\PostCategoryController as PostCategoryV1;
use  App\Http\Controllers\Api\v1\NotificationController as NotificationV1;
use  App\Http\Controllers\Api\v1\AttendanceController as AttendanceV1;
use  App\Http\Controllers\Api\v1\ApprovedPostController as ApprovedPostV1;


Route::get('v1/user', [UserV1::class, 'index'])->middleware('auth:sanctum');
Route::get('v1/user/{id}', [UserV1::class, 'show'])->middleware('auth:sanctum');
Route::post('v1/user', [UserV1::class, 'store'])->middleware('auth:sanctum');
Route::put('v1/user/{id}', [UserV1::class, 'update'])->middleware('auth:sanctum');
Route::delete('v1/user/{id}', [UserV1::class, 'destroy'])->middleware('auth:sanctum');

Route::get('v1/post', [PostV1::class, 'index'])->middleware('auth:sanctum');
Route::get('v1/post/{id}', [PostV1::class, 'show'])->middleware('auth:sanctum');
Route::post('v1/post', [PostV1::class, 'store'])->middleware('auth:sanctum');
Route::put('v1/post/{id}', [PostV1::class, 'update'])->middleware('auth:sanctum');
Route::delete('v1/post/{id}', [PostV1::class, 'destroy'])->middleware('auth:sanctum');

Route::get('v1/role', [UserRoleV1::class, 'index'])->middleware('auth:sanctum');
Route::get('v1/role/{id}', [UserRoleV1::class, 'show'])->middleware('auth:sanctum');
Route::post('v1/role', [UserRoleV1::class, 'store'])->middleware('auth:sanctum');
Route::put('v1/role/{id}', [UserRoleV1::class, 'update'])->middleware('auth:sanctum');
Route::delete('v1/role/{id}', [UserRoleV1::class, 'destroy'])->middleware('auth:sanctum');

Route::get('v1/report', [ReportV1::class, 'index'])->middleware('auth:sanctum');
Route::get('v1/report/{id}', [ReportV1::class, 'show'])->middleware('auth:sanctum');
Route::post('v1/report', [ReportV1::class, 'store'])->middleware('auth:sanctum');
Route::put('v1/report/{id}', [ReportV1::class, 'update'])->middleware('auth:sanctum');
Route::delete('v1/report/{id}', [ReportV1::class, 'destroy'])->middleware('auth:sanctum');

Route::get('v1/post-category', [PostCategoryV1::class, 'index'])->middleware('auth:sanctum');
Route::get('v1/post-category/{id}', [PostCategoryV1::class, 'show'])->middleware('auth:sanctum');
Route::post('v1/post-category', [PostCategoryV1::class, 'store'])->middleware('auth:sanctum');
Route::put('v1/post-category/{id}', [PostCategoryV1::class, 'update'])->middleware('auth:sanctum');
Route::delete('v1/post-category/{id}', [PostCategoryV1::class, 'destroy'])->middleware('auth:sanctum');

Route::get('v1/notification', [NotificationV1::class, 'index'])->middleware('auth:sanctum');
Route::get('v1/notification/{id}', [NotificationV1::class, 'show'])->middleware('auth:sanctum');
Route::post('v1/notification', [NotificationV1::class, 'store'])->middleware('auth:sanctum');
Route::put('v1/notification/{id}', [NotificationV1::class, 'update'])->middleware('auth:sanctum');
Route::delete('v1/notification/{id}', [NotificationV1::class, 'destroy'])->middleware('auth:sanctum');

Route::get('v1/attendance', [AttendanceV1::class, 'index'])->middleware('auth:sanctum');
Route::get('v1/attendance/by-username/{user_username}', [AttendanceV1::class, 'getAttendancesByUsername'])->middleware('auth:sanctum');
Route::get('v1/attendance/by-post/{post_id}', [AttendanceV1::class, 'getAttendancesByPost'])->middleware('auth:sanctum');
Route::post('v1/attendance', [AttendanceV1::class, 'store'])->middleware('auth:sanctum');
Route::put('v1/attendance/{id}', [AttendanceV1::class, 'update'])->middleware('auth:sanctum');
Route::delete('v1/attendance/{id}', [AttendanceV1::class, 'destroy'])->middleware('auth:sanctum');

Route::get('v1/post-approved', [ApprovedPostV1::class, 'index'])->middleware('auth:sanctum');
Route::get('v1/post-approved/{id}', [ApprovedPostV1::class, 'show'])->middleware('auth:sanctum');
Route::post('v1/post-approved', [ApprovedPostV1::class, 'store'])->middleware('auth:sanctum');
Route::put('v1/post-approved/{id}', [ApprovedPostV1::class, 'update'])->middleware('auth:sanctum');
Route::delete('v1/post-approved/{id}', [ApprovedPostV1::class, 'destroy'])->middleware('auth:sanctum');

Route::post('login', [
    App\Http\Controllers\Api\LoginController::class,
    'login'
]);

Route::post('register', [
    App\Http\Controllers\Api\RegisterController::class,
    'register'
]);

Route::post('profile', [
    App\Http\Controllers\Api\LoginController::class,
    'profile'
]);

Route::get('update-passwords', function () {
    $users = User::all();

    foreach ($users as $user) {
        if (Hash::needsRehash($user->password)) {
            $user->password = bcrypt($user->password);
            $user->save();
        }
    }

    return 'Contraseñas actualizadas correctamente';
});
