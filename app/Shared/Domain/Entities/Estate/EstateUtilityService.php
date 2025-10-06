<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entities\Estate;

use App\Shared\Domain\Enum\Renter\EstateUtilityServiceType;

final class EstateUtilityService
{
    public function __construct(
        public ?int $id = null,
        public ?int $estateId = null,
        public ?EstateUtilityServiceType $serviceType = null,  
        public ?string $ownerName = null,
        public ?string $counterNumber = null,
        public ?string $electronicPaymentNumber = null,
        public ?string $note = null,
    ) {}
}
