<?php
declare (strict_types=1);
namespace App\Features\Transactions\Application\Outputs;

use App\Shared\Domain\Entities\Transaction\TransactionEntity;

interface StoreTransactionOutput {
    public function onSuccess(TransactionEntity $transactionEntity):void;
    public function onFailure(string $error):void;

}