<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class IucnApi
{
    public function regions(){
        return Http::get(
            env('IUCN_BASE_PATH').'/region/list?'.$this->token());
    }

    private function token(): string
    {
        return 'token='.env('IUCN_TOKEN');
    }
}
