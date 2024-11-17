<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait IucnHttpRequest
{
    function iucnGet(string $path)
    {
        return Http::get(env('IUCN_BASE_PATH').$path.$this->token());
    }

    private function token(): string
    {
        return '?token='.env('IUCN_TOKEN');
    }
}
