<?php

namespace App\Http\Controllers;

use App\Services\IucnService;

class IucnController extends Controller
{

    public function getCriticallyEndangered(IucnService $iucnService)
    {
        return $iucnService->crSpecies();
    }

    public function getMammals(IucnService $iucnService)
    {
        return $iucnService->mammalSpecies();
    }
}

