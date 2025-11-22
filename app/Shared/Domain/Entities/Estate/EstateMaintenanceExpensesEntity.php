<?php

declare(strict_type=1);

namespace App\Shared\Domain\Entities\Estate;

use App\Shared\Domain\Contracts\DateProviderContract;
use App\Shared\Domain\Entities\Transaction\TransactionEntity;

final class EstateMaintenanceExpensesEntity
{
    public function __construct(
        public ?int $id = null,
        public ?int $estateId = null,
        public ?string $title = null,
        public ?string $description = null,
        public ?TransactionEntity $transaction = null,
        public ?EstateEntity $estate = null,
    ) {
    }
}
