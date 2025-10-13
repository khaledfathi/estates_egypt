<?php
declare(strict_types=1);
namespace App\Features\UnitOwnerships\Application\Outputs;

use App\Shared\Domain\Entities\Unit\UnitEntity;

interface CreateUnitOwnershipOutput{
    public function onSuccess (UnitEntity $unitEntity) :void;
    public function onUnitNotFound() :void;
    public function onFailure(string $error) :void;
}