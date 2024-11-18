<?php

namespace App\Services;

use App\Traits\IucnHttpRequest;
use Illuminate\Support\Collection;

class IucnApi
{
    use IucnHttpRequest;

    public function regions(): Collection
    {
        return collect($this->iucnGet('/region/list')['results']);
    }

    public function species($region = null): Collection
    {
        return collect($this->iucnGet('/species'.($region ? '/region/'.$region : '').'/page/0')['result']);
    }

    public function conservationMeasures(int $speciesId): Collection
    {
        return collect($this->iucnGet('/measures/species/id/'.$speciesId.'/')['result']);
    }
}
