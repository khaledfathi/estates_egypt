<?php
declare (strict_types=1);

namespace App\Features\Transactions\Application\Outputs;

use App\Shared\Domain\Entities\Transaction\TransactionEntity; 

interface UpdateTransactionOutput{
   public function onSuccess (bool $status):void;
   public function onFailure( string $error):void;
} 