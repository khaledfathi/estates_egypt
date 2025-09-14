<?php 
declare(strict_types= 1);
namespace App\Shared\Domain\Entities\Owner;


final class OwnerEntity {
    /**
     * 
     * @param ?int $id
     * @param ?string $name
     * @param ?string $nationalId
     * @param ?string $address
     * @param ?array<OwnerPhoneEntity> $phones
     * @param ?string $notes
     */
    public function __construct(
        public ?int $id = null, 
        public ?string $name = null, 
        public ?string $nationalId = null, 
        public ?string $address = null, 
        public ?array $phones= null, 
        public ?string $notes = null, 
    ) {}
}