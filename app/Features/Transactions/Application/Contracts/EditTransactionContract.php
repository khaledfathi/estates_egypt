<?php
declare (strict_types=1);

namespace App\Features\Transactions\Application\Contracts;

use App\Features\Transactions\Application\Outputs\EditTransactionOutput; 


interface EditTransactionContract{
   public function execute(int $transactionId , EditTransactionOutput $presenter);
} 