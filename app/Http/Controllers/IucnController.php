<?php

namespace App\Http\Controllers;

use App\Services\IucnApi;

class IucnController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(IucnApi $iucnApi)
    {
        // 1
        $regions = $iucnApi->regions();
        // 2
        $randRegion = $regions->random();
        // 3 - 4
        $species = $iucnApi->species($randRegion['identifier']);
        // 5
        $crSpecies = $species->filter(fn($element) => $element['category'] == 'CR');

        foreach ($crSpecies as $sp) {
            $conservationMeasures[$sp['taxonid']] = collect($iucnApi->conservationMeasures($sp['taxonid']))->implode('title',
                ' , ');
        }

        $crSpecies = $crSpecies->map(function ($element) use ($conservationMeasures) {
            $element['cm'] = array_key_exists($element['taxonid'],
                $conservationMeasures) ? $conservationMeasures[$element['taxonid']] : '';
            return $element;
        });
        // 6
        $mammalSpecies = $species->filter(fn($s) => $s['class_name'] == 'MAMMALIA');

    }
}

