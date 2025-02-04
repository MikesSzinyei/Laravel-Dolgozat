<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/createcity", [CityController::class, "createCity"]);

Route::post( "/register", [ AuthController::class, "register" ]);
Route::post( "/login", [ AuthController::class, "login" ]);



Route::group(["middleware" => ["auth:sanctum"]], function() {

    Route::post( "/logout", [ AuthController::class, "logout" ]);
    Route::get( "/user/{id}", [ ProfileController::class, "getUserProfileData" ]);
    Route::post( "/modifyuser", [ ProfileController::class, "setUserProfileData" ]);
    Route::post( "/newpassword", [ ProfileController::class, "setNewPassword" ]);
    Route::delete( "/deleteuser", [ ProfileController::class, "deleteAccount" ]);

});
