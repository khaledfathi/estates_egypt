<?php

declare(strict_types=1);

namespace App\Features\Transactions\Presentation\Http\Presenters;

use App\Features\Transactions\Application\Outputs\DestroyTransactionOutput;
use App\Shared\Infrastructure\Logging\Constants\LogChannels;
use App\Shared\Infrastructure\Session\Constants\SessionKeys;
use App\Shared\Presentation\Constants\Messages;
use Closure;
use Illuminate\Support\Facades\Log;

final class DestroyTransactionPresenter implements DestroyTransactionOutput
{

   public Closure $response;
   public function onSuccess(bool $status): void
   {
      $this->response = fn() => redirect(route('transactions.index'))
         ->with('success', Messages::DESTROY_SUCCESS);
   }
   public function onFailure(string $error)
   {
      $this->response = fn() => back()
         ->with('error', Messages::INTERNAL_SERVER_ERROR);
      //log
      Log::channel(LogChannels::ERROR)
         ->error('Databse failure', ['error' => $error, 'error_source' => __CLASS__ . '::' . __FUNCTION__]);
   }
   public function handle()
   {
      return ($this->response)();
   }
}
