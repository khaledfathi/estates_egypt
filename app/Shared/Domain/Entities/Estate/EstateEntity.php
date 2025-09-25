<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entities\Estate;

use App\Shared\Domain\Entities\Unit\UnitEntity;

final class EstateEntity
{
    /**
     * 
     * @param ?int $id
     * @param ?string $name
     * @param ?string $address
     * @param ?int $floorCount
     * @param ?int $unitCount
     * @param ?int $commercialUnitCount= null,
     * @param ?int $residentialUnitCount= null,
     * @param ?array<EstateDocumentEntity> $documents
     * @param ?array<EstateUtilityService> $utilityServices
     * @param ?array<EstateUtilityServiceInvoiceEntity> $utilityServiceInvoices
     * @param ?array<UnitEntity> $units
     */
    public function __construct(
        public ?int $id = null,
        public ?string $name = null,
        public ?string $address = null,
        public ?int $floorCount = null,
        public ?int $unitCount = null,
        public ?int $commercialUnitCount = null,
        public ?int $residentialUnitCount = null,
        public ?array $documents = null,
        public ?array $utilityServices = null,
        public ?array $utilityServiceInvoices = null,
        public ?array $units = null,
    ) {}

}
