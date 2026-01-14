<?php

declare(strict_types=1);

namespace App\Features\Transactions\Presentation\Http\Presenters;

use App\Features\Transactions\Application\Outputs\ShowTransactionOutput;
use App\Shared\Domain\Entities\Transaction\TransactionEntity;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class ShowTransactionPresenter implements ShowTransactionOutput
{
    private Closure $response;
    public function __construct()
    {
        $this->handleSession();
    }
    private function handleSession()
    {
        $previousPage = SessionKeys::TRANSACTION_EDIT_PREVIOUS_PAGE;
        session()->put($previousPage, request()->fullUrl());
    }
    public function onSuccess(TransactionEntity $transactionEntity): void
    {
        $this->response = fn() => view('transactions::show', ['transaction' => $transactionEntity]);
    }
    public function onNotFound(): void
    {
        $this->response =fn()=> view("transactions::show", [
            'error' => Messages::DATA_NOT_FOUND,
        ]);
    }
    public function onFailure(string $error): void
    {
        $this->response = fn() => view("transactions::show", [
            'error' => Messages::INTERNAL_SERVER_ERROR,
        ]);
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
