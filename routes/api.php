<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;

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

Route::group([ 'prefix' => 'auth'], function ()
{ 
    Route::post('login', [Authentication::class, 'login']);

    /* ------------- After login call with Authorization for customer ------------ */
    Route::group([
        
          'middleware' => 'auth:customers-api',
        ], 
        function() {

            /* ----------------- Customer Controller ---------------- */
            Route::post('logout', [Authentication::class, 'logout']);
        
        }
    );
}); 
