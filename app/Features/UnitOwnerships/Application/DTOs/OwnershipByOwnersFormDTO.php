<?php
declare (strict_types=1);
namespace App\Features\UnitOwnerships\Application\DTOs;

final class OwnershipByOwnersFormDTO {
    /**
     * @param int $unitId
     * @param array<int> $ownersIds
     */
    public function __construct(
        public int $unitId, 
        public array $ownersIds, 
    ){}
}