
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookshelfController;

Route::middleware('api')->group(function () {
    Route::get('/bookshelves', [BookshelfController::class, 'index']);
    Route::post('/bookshelves', [BookshelfController::class, 'store']);
});
