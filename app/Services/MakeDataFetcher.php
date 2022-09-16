<?php

namespace App\Services;

use App\DataFetchers\DataFetcherContract;
use Illuminate\Contracts\Container\Container;

class MakeDataFetcher
{
    protected Container $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function execute(string $type): DataFetcherContract
    {
        $dataFetcherFQCN = \App::getNamespace() . "DataFetchers\\" . \Str::studly($type) . 'DataFetcher';

        return $this->app->make($dataFetcherFQCN);
    }
}
