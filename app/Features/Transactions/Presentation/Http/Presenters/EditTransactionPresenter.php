<?php

declare(strict_types=1);

namespace App\Features\Transactions\Presentation\Http\Presenters;

use App\Features\Transactions\Application\Outputs\EditTransactionOutput;
use App\Shared\Domain\Entities\Transaction\TransactionEntity;
use App\Shared\Domain\Enum\Transaction\TransactionDirection;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Log;

final class EditTransactionPresenter implements EditTransactionOutput
{
   private Closure $response;
   private string $previousURL;
   public function __construct()
   {
      $this->handleSession();
   }
   private function handleSession()
   {
      $previousPage = SessionKeys::TRANSACTION_EDIT_PREVIOUS_PAGE;
      $this->previousURL = session($previousPage) ?? url()->previous();
   }
   public function onSuccess(TransactionEntity $transactionEntity): void
   {
      $this->response = fn() => view('transactions::edit', [
         'transaction' => $transactionEntity,
         'transactionDirections' => TransactionDirection::labels(),
         'currentDate' => Carbon::now()->toDateString(),
         'previousURL' => $this->previousURL
      ]);
   }
   public function onNotFound()
   {
      $this->response = fn() => view("transactions::edit", [
         'error' => Messages::DATA_NOT_FOUND,
      ]);
   }
   public function onFailure(string $error)
   {
      $this->response = fn() => view("transactions::edit", [
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
