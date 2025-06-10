<?php

use Illuminate\Support\Facades\Route;
use screenWidth\app\Http\Controllers\screenWidthController;

Route::group(
    [
        'middleware' => 'web',
        'namespace'  => 'screenWidth\dapp\Http\Controllers',
    ],
    function () {
        Route::get('/getscreenWidth', [screenWidthController::class, 'getscreenWidth'])->name('getscreenWidth');
        Route::post('/setscreenWidth', [screenWidthController::class, 'setscreenWidth'])->name('setscreenWidth');
        Route::get('/checkscreenWidth', [screenWidthController::class, 'checkscreenWidth'])->name('checkscreenWidth');
        Route::post('/reportWindowSize', [screenWidthController::class, 'reportWindowSize'])->name('reportWindowSize');
    }
);
