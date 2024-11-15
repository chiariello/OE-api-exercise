<?php

namespace App\Services;

use Illuminate\Support\Collection;

class IucnService
{

    private $species;

    public function __construct(protected IucnApi $iucnApi)
    {
        $this->species = $this->iucnApi->species($this->iucnApi->regions()->random()['identifier']);
    }

    public function mammalSpecies(): Collection
    {
        return $this->species
            ->filter(fn($s) => $s['class_name'] == 'MAMMALIA');
    }

    public function crSpecies(): Collection
    {

        $crSpecies = $this->species
            ->filter(fn($element) => $element['category'] == 'CR');

        $conservationMeasures = $this->conservationMeasures($crSpecies);

        return $crSpecies->map(function ($element) use ($conservationMeasures) {
            $element['cm'] = array_key_exists($element['taxonid'], $conservationMeasures) ?
                $conservationMeasures[$element['taxonid']] :
                '';
            return $element;
        });
    }

    private function conservationMeasures($crSpecies): array
    {
        foreach ($crSpecies as $sp) {
            $conservationMeasures[$sp['taxonid']] = collect($this->iucnApi->conservationMeasures($sp['taxonid']))
                ->implode('title', ' , ');
        }
        return $conservationMeasures;
    }
}
