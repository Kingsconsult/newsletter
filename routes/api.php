<?php

use App\Http\Controllers\Api\NewsletterController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::post('subscription', )
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);

Route::get('newsletter', [NewsletterController::class, 'index']);
Route::get('newsletter/{id}', [NewsletterController::class, 'show']);
Route::post('newsletter', [NewsletterController::class, 'store']);
Route::put('newsletter/{id}', [NewsletterController::class, 'update']);
Route::delete('newsletter/{id}', [NewsletterController::class, 'destroy']);
