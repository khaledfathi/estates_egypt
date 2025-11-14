<?php
declare (strict_types=1);
namespace App\Features\Transactions\Application\Outputs;

use App\Shared\Domain\Entities\Transaction\TransactionEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination; 

interface ShowTransactionsPaginationOutput{
    /**
     * @param EntitiesWithPagination<TransactionEntity> $entitiesWithPagination
     * @return void
     */
    public function onSuccess (EntitiesWithPagination $entitiesWithPagination , int $balance):void;
    public function onFailure (string $error) :void;
}