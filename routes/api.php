<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;

Route::resource('products', ProductController::class, 
    ['except' =>[
        'create',
        'edit'
    ]
]);