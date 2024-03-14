<?php

use App\Http\Controllers\Api\CircleController;
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


// LaravelのAPIルートは、`/api`プレフィクスが自動的に適用される

// `/api/circles/ranking`: カスタムアクションのルート定義（リソースコントローラーより前に）
Route::get('/circles/ranking', [CircleController::class, 'ranking']);
// `/api/circles/`
Route::apiResource('circles', CircleController::class);
