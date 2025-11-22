<?php
declare (strict_types=1);

namespace App\Features\Transactions\Application\Contracts;

use App\Features\Transactions\Application\Outputs\DestroyTransactionOutput;

interface DestroyTransactionContract{
   public function execute(int $transactionId , DestroyTransactionOutput $presenter);
} 