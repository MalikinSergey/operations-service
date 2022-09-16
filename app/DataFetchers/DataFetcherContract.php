<?php

namespace App\DataFetchers;

interface DataFetcherContract
{
    public function execute($transactionID): array;
}
