<?php

namespace App\Jobs;

use App\Models\Operation;
use App\Repositories\OperationRepository;
use App\Services\MakeDataFetcher;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateOperationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $type;
    protected int $transactionID;

    public function __construct(string $type, int $transactionID)
    {
        $this->type = $type;
        $this->transactionID = $transactionID;
    }

    public function handle(OperationRepository $operationRepository, MakeDataFetcher $makeDataFetcher): Operation
    {
        // получаем необходимый сборщик данных

        $dataFetcher = $makeDataFetcher->execute($this->type);

        // при помощи сборщика получаем унифицированные данные для операции

        $data = $dataFetcher->execute($this->transactionID);

        // обновляем данные операции

        $operation = $operationRepository->create($this->transactionID, $this->type, $data);

        return $operation;
    }


}
