<?php

use App\Http\Controllers\User\UserCreateController;
use App\Http\Controllers\User\UserDeleteController;
use App\Http\Controllers\User\UserReadController;
use App\Http\Controllers\User\UserUpdateController;
use App\Http\Controllers\User\UserUploadImageController;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::get('/loop100', function () {
    $totalNumber = 100;
    $counter = 0;

    $results = [];

    while ($counter < $totalNumber) {
        $counter++;
        if ($counter % 15 === 0) {
            $results[] = 'Mari Berkarya';
        } elseif ($counter % 3 === 0) {
            $results[] = 'Mari';
        } elseif ($counter % 5 === 0) {
            $results[] = 'Berkarya';
        } else {
            $results[] = $counter;
        }
    }
    return response()->json(implode(', ', $results));
});

Route::get('/piramida', function () {
    $totalStars = 9;
    $counter = 1;
    $results = '';

    // 9
    // 7 \\ 2
    // 5 \\ 4
    // 3 \\ 6
    // 1 \\ 8
    while ($counter <= $totalStars) {
        $starCount = 0;
        $starsChar = '';
        $space = 9 - $totalStars;
        $space = $space / 2;
        while ($starCount < 9) {
            // if ($starCount < $space && ($space - 9) < ) {
            //     $starsChar .= "_";
            // } else {
            //     $starsChar .= '*';
            // }
            $starCount++;
        }
        $results .= $starsChar;
        $results .= '\n';
        $totalStars -= 2;
    }

    return response()->json($results);
});

Route::prefix('users')->group(function () {
    Route::get('/', UserReadController::class);
    Route::post('/', UserCreateController::class);
    Route::patch('/{id}', UserUpdateController::class);
    Route::delete('/{id}', UserDeleteController::class);
    Route::post('/{id}', UserUploadImageController::class);
})->middleware('auth:web');
