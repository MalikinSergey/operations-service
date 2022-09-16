<?php

namespace App\DataFetchers;

use Faker;
use GuzzleHttp\Client;

class FakeBankStatementDataFetcher implements DataFetcherContract
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function execute($transactionID): array
    {
        $data = [];

        $data['sender_type'] = 'company';

        $data['receiver_type'] = 'company';

        $billingResponse = $this->client->get(
            "https://httpbin.org/get?transaction_id=$transactionID" .
            "&company_id=" . mt_rand(100000, 900000) .
            "&sum=" . mt_rand(100000, 900000) .
            "&reason=" . (Faker\Factory::create())->sentence .
            "&bank_bic=04" . mt_rand(1000000, 9000000)
        );

        $raw = json_decode($billingResponse->getBody(), true);

        $data['sum'] = $raw['args']['sum'];

        $data['reason'] = $raw['args']['reason'];

        $data['info']['bank']['bic'] = $raw['args']['bank_bic'];

        $backendResponse = $this->client->get(
            "https://httpbin.org/get?company_id=$transactionID" .
            '&company_name=' . (Faker\Factory::create())->company
        );

        $raw = json_decode($backendResponse->getBody(), true);

        $data['sender']['name'] = $raw['args']['company_name'];

        $data['receiver']['name'] = $raw['args']['company_name'];

        return $data;
    }
}
