<?php

use App\Http\Controllers\IucnController;
use Illuminate\Support\Facades\Route;

Route::controller(IucnController::class)
    ->group(function () {
        Route::get('/iucn/species/critically-endangered', 'getCriticallyEndangered');
        Route::get('/iucn/species/mammals', 'getMammals');
    });
