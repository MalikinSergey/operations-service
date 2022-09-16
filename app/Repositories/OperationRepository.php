<?php

namespace App\Repositories;

use App\Models\Operation;

class OperationRepository
{
    public function create(int $transactionID, string $type, array $data): Operation
    {
        $operation = new Operation();

        $operation->transaction_id = $transactionID;

        $operation->type = $type;

        $operation->fill($data);

        $operation->save();

        return $operation;
    }

    public function update(Operation $operation, array $data): bool
    {
        return $operation->update($data);
    }

    public function all(){
        return Operation::orderBy('id', 'desc')->get();
    }

}
