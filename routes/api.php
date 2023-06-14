<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ProductController;

/*
Route::prefix('v1')->controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::prefix('v1')->group(function () {

    Route::post('/products/search', [ProductController::class, 'search'])->name('products.search');
    
    Route::resource('products', ProductController::class, 
        ['except' =>[
            'create',
            'edit'
        ]
    ]);

});
*/

Route::group([
    'middleware' => 'api', 'auth',
    'prefix' => 'v1'
], function ($router) {

    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('auth.refresh');

    Route::post('/products/search', [ProductController::class, 'search'])->name('products.search');

    Route::resource('products', ProductController::class, 
        ['except' =>[
            'create',
            'edit'
        ]
    ]);

});