<?php
declare( strict_types=1);

namespace App\Features\Transactions\Application\Contracts;


interface StoreTransactionContract  {
    public function execute ( );
}