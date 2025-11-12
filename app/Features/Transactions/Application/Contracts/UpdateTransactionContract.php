<?php
declare (strict_types=1);

namespace App\Features\Transactions\Application\Contracts;

use App\Features\Transactions\Application\Outputs\UpdateTransactionOutput;
use App\Shared\Domain\Entities\Transaction\TransactionEntity;

interface UpdateTransactionContract{
   public function execute(TransactionEntity $transactionEntity , UpdateTransactionOutput $presenter);
} 