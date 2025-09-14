<?php
declare(strict_types= 1);
namespace App\Shared\Domain\Entities\Renter;

use App\Shared\Domain\Enum\Renter\RenterIdentityType;

final class RenterEntity {
    /**
     * 
     * @param ?int$id
     * @param ?string $name
     * @param ?RenterIdentityType $identityType
     * @param ?string $identityNumber
     * @param ?array<RenterPhoneEntity> $phones
     * @param ?string $notes
     */
    public function __construct(
        public ?int $id = null,
        public ?string $name = null,
        public ?RenterIdentityType $identityType = null,
        public ?string $identityNumber = null ,
        public ?array $phones = null,
        public ?string $notes = null,
    ){ }

}