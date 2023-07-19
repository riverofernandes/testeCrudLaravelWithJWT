<?php

use App\Http\Controllers\Controller;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', function (Request $request) {
    $credentials = $request->only(['email', 'password']);

    if (!$token = auth()->attempt($credentials)) {
        abort(401, 'Unauthorized');
    }
    return response()->json([
        'data' => [
            'token' => $token,
            'token_type' => 'bearer',
            'espires_in' => auth()->factory()->getTTL() * 60,
        ]
    ]);
});

Route::middleware('auth:api')->prefix('products')->group(function () {
    Route::get('', [Controller::class, 'index']);
    Route::post('', [Controller::class, 'store']);
    Route::get('{id}', [Controller::class, 'show']);
    Route::put('{id}', [Controller::class, 'update']);
    Route::delete('{id}', [Controller::class, 'destroy']);
});
