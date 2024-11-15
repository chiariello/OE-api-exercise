<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class IucnApi
{
    public function regions(): Collection
    {
        return collect(Http::get(
            env('IUCN_BASE_PATH').'/region/list?'.$this->token())['results']);

    }

    private function token(): string
    {
        return 'token='.env('IUCN_TOKEN');
    }

    public function species($region = null): Collection
    {
        return collect(
            Http::get(
                env('IUCN_BASE_PATH').'/species'.($region ? '/region/'.$region : '').'/page/0?'.$this->token()
            )['result']
        );
    }

    public function conservationMeasures(int $speciesId): Collection
    {
        return collect(
            Http::get(
                env('IUCN_BASE_PATH').'/measures/species/id/'.$speciesId.'/?'.$this->token()
            )['result']
        );
    }
}
