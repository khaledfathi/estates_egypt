<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entities\Owner;


final class OwnerEntity
{
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
        public ?array $phones = null,
        public ?string $notes = null,
    ) {}

    /**
     * convert array of OwnerEntity to array of arrays
     * @param array<OwnerEntity> $data
     * @return void
     */
    public static function toArrayCollection(array $data): array
    {
        return array_map(fn(OwnerEntity $owner) => $owner->toArray(), $data);
    }
    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'national_id' => $this->nationalId,
            'address' => $this->address,
            'phones' => $this->getPhonesAsArray(),
            'notes' => $this->notes,
        ];
    }
    public function getPhonesAsArray(): array
    {
        return $this->phones
            ? array_map(fn(OwnerPhoneEntity $phone) => $phone->phone, $this->phones)
            : [];
    }
}
