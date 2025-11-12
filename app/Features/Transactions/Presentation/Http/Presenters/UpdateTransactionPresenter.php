<?php
declare (strict_types=1);

namespace App\Features\Transactions\Presentation\Http\Presenters;

use App\Features\Transactions\Application\Outputs\UpdateTransactionOutput;
use App\Shared\Domain\Entities\Transaction\TransactionEntity;
use Closure;

final class UpdateTransactionPresenter implements UpdateTransactionOutput{
   private Closure $response;
   public function onSuccess (bool $status):void{
      dd('success', $status);
   }
   public function onFailure( string $error):void{
      dd('failure');
   }
   public function handle(){
      return __CLASS__."::".__FUNCTION__;
   }
} 