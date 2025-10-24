<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entities\Estate;

use App\Shared\Domain\Enum\Estate\EstateUtilityServiceType;

final class EstateUtilityServiceEntity
{
    /**
     * @param ?int $id
     * @param ?int $estateId
     * @param ?EstateUtilityServiceType $type
     * @param ?string $ownerName
     * @param ?string $counterNumber
     * @param ?string $electronicPaymentNumber
     * @param ?string $notes
     * @param ?EstateEntity$estate
     * @param ?array<EstateUtilityServiceInvoiceEntity> $invoices
     */
    public function __construct(
        public ?int $id = null,
        public ?int $estateId = null,
        public ?EstateUtilityServiceType $type= null,  
        public ?string $ownerName = null,
        public ?string $counterNumber = null,
        public ?string $electronicPaymentNumber = null,
        public ?string $notes = null,
        public ?EstateEntity $estate = null,
        public ?array $invoices = null,
    ) {}
}
