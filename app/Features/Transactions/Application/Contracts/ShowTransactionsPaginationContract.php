<?php
declare (strict_types=1);
namespace App\Features\Transactions\Application\Contracts;

use App\Features\Transactions\Application\Outputs\ShowTransactionsPaginationOutput;

interface ShowTransactionsPaginationContract {
   public function execute (string $date, ShowTransactionsPaginationOutput $presenter , int $perPage=10);
}