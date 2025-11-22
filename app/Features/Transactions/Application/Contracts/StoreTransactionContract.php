<?php
declare( strict_types=1);

namespace App\Features\Transactions\Application\Contracts;

use App\Features\Transactions\Application\Outputs\StoreTransactionOutput;
use App\Shared\Domain\Entities\Transaction\TransactionEntity;

interface StoreTransactionContract  {
    public function execute ( TransactionEntity $transactionEntity , StoreTransactionOutput $presnter );
}