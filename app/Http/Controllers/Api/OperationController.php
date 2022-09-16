<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreOperationRequest;
use App\Jobs\CreateOperationJob;
use App\Repositories\OperationRepository;

class OperationController
{

    public function index(OperationRepository $operationRepository)
    {
        // но конечно такое ответы мы юзать не будем
        return response()->json($operationRepository->all(), 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function store(StoreOperationRequest $request)
    {
        CreateOperationJob::dispatchSync($request->input('type'), $request->input('transaction_id'));

        // но конечно такое ответы мы юзать не будем
        return ['success' => true];
    }
}
