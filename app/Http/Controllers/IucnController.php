<?php

namespace App\Http\Controllers;

use App\Services\IucnService;

class IucnController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(IucnService $iucnService)
    {
        return $iucnService->mammalSpecies();
    }
}

