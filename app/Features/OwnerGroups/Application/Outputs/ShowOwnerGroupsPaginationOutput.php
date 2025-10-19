<?php
declare (strict_types=1);
namespace App\Features\OwnerGroups\Application\Outputs;

use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

interface ShowOwnerGroupsPaginationOutput {
    public function onSuccess( EntitiesWithPagination $ownerGroupsEntitiesWithPagination);
    public function onFailure(string $error);
}