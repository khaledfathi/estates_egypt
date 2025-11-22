<?php

declare(strict_types=1);

namespace App\Features\Transactions\Presentation\Http\Presenters;

use App\Features\Transactions\Application\Outputs\StoreTransactionOutput;
use App\Shared\Domain\Entities\Transaction\TransactionEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class StoreTransactionPresenter implements StoreTransactionOutput
{

    private Closure $response;
    public function onSuccess(TransactionEntity $transactionEntity): void
    {
        $this->response = fn() => redirect(route('transactions.index'))
            ->with('success', Messages::STORE_SUCCESS);
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => back()
            ->withInput()
            ->with('error', Messages::INTERNAL_SERVER_ERROR);
        //log
        Log::channel(LogChannels::ERROR)->error(
            'Databse failure',
            ['error' => $error,  'error_source' => __CLASS__ . '::' . __FUNCTION__]
        );
    }
    public function handle()
    {
        return ($this->response)();
    }
}
