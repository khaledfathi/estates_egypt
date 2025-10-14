<?php
declare (strict_types=1);
namespace App\Features\OwnerGroups\Application\Outputs;

use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

interface ShowOwnerGroupsPaginateOutput {
    public function onSuccess( EntitiesWithPagination $ownerGroupsEntitiesWithPagination);
    public function onFailure(string $error);
}