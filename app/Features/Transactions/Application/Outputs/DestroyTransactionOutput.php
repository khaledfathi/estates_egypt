<?php
declare (strict_types=1);

namespace App\Features\Transactions\Application\Outputs; 



interface DestroyTransactionOutput{

   public function onSuccess(bool $status): void;
   public function onFailure(string $error);
} 