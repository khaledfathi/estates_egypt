<?php
declare (strict_types=1);

namespace App\Shared\Domain\Entities\SharedWaterInvoice;

use App\Shared\Domain\Entities\Transaction\TransactionEntity;
use App\Shared\Domain\Entities\Unit\UnitContractEntity;

class SharedWaterInvoiceEntity {
    public function __construct(
        public ?int $id = null,
        public ?int $contractId = null,
        public ?int $transactionId = null,
        public ?float $sharedValue= null ,
        public ?int $forMonth = null ,
        public ?int $forYear = null,
        public ?TransactionEntity $transaction= null,
        public ?UnitContractEntity $unitContract = null,
    ) { }
}