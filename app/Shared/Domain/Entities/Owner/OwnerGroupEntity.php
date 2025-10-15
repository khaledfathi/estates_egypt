<?php

declare(strict_types=1);

namespace App\Shared\Domain\Entities\Owner;

final class OwnerGroupEntity
{
    /**
     * 
     * @param ?int $id
     * @param ?string $name
     * @param ?int $ownersCount count of owners in this group
     * @param ?array<OwnerEntity> $owners owenrs entities that registered in this group 
     */
    public function __construct(
        public ?int $id = null,
        public ?string $name = null,
        public ?int $ownersCount = null,
        public ?array $owners = null,
    ) {}
}
