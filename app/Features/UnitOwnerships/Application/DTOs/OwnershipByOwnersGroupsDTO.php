<?php
declare(strict_types=1);
namespace App\Features\UnitOwnerships\Application\DTOs;

final class OwnershipByOwnersGroupsDTO {
    /**
     * @param int $unitId
     * @param array<int> $groupsIds
     */
    public  function __construct(
        public int $unitId,
        public array $groupsIds,
    ){}
}