<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ProductController;

Route::prefix('v1')->group(function () {

    Route::post('/products/search', [ProductController::class, 'search'])->name('products.search');
    
    Route::resource('products', ProductController::class, 
        ['except' =>[
            'create',
            'edit'
        ]
    ]);

});