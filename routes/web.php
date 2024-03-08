<?php

use App\Http\Controllers\CircleController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::prefix('circles')  // URLルート circles/ に対応
->controller(CircleController::class)  // このルートグループの全てのルートが CircleController を使用する
->name('circles.')  // ルートの名前に circles. のプレフィクスを設定
->group(function() {
    Route::get('/ranking', 'ranking')->name('ranking');  // URLパス circles/ranking に対して CircleController.ranking にルーティングする。このルートに circles.ranking の名前を指定する
});
