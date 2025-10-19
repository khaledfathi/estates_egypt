<?php
declare(strict_types=1);
namespace App\Features\UnitOwnerships\Application\Outputs;

use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;
use App\Shared\Domain\Entities\Unit\UnitEntity;

interface CreateUnitOwnershipOutput{
    /**
     * @param UnitEntity $unitEntity
     * @param array<OwnerGroupEntity> $ownerGroupEntities
     * @return void
     */
    public function onSuccess (UnitEntity $unitEntity , array $ownerGroupEntities) :void;
    public function onUnitNotFound() :void;
    public function onFailure(string $error) :void;
}