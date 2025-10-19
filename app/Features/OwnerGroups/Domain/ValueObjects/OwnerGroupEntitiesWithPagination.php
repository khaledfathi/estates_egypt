<?php
declare (strict_types= 1);

namespace App\Features\OwnerGroups\Domain\ValueObjects; 

use App\Shared\Domain\Entities\Owner\OwnerGroupEntity;
use App\Shared\Domain\ValueObjects\EntitiesWithPagination;

/**
 * @extends EntitiesWithPagination<OwnerGroupEntity> 
 */
final class OwnerGroupEntitiesWithPagination extends EntitiesWithPagination{ }